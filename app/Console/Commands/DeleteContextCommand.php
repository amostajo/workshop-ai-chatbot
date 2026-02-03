<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\UploadedFile;
use Exception;
use Illuminate\Console\Command;
use Gemini;
use Log;
use Storage;

/**
 * This command deletes file context provided to the AI.
 * 
 * @author Ale Mostajo <https://github.com/amostajo>
 * @version 1.0.0
 */
class DeleteContextCommand extends Command
{
    /**
     * The name and signature of the console command.
     * @since 1.0.0
     * 
     * @command-arg string {provider} Is the provider name.
     *
     * @var string
     */
    protected $signature = 'app:delete-context {provider}';

    /**
     * The console command description.
     * @since 1.0.0
     *
     * @var string
     */
    protected $description = 'Removes all context files from AI provider.';

    /**
     * Execute the console command.
     * @since 1.0.0
     */
    public function handle()
    {
        try {
            switch ($this->argument('provider')) {
                case 'gemini':
                    $client = Gemini::client(config('services.gemini.key'));
                    // Remove local references
                    UploadedFile::truncate();
                    $this->info('File references deleted');
                    // Remove all uploaded files
                    $response = $client->files()->list(pageSize: 10);
                    foreach ($response->files as $file) {
                        $client->files()->delete($file->uri, force: true);
                        $this->info("Existing $file->uri has been deleted");
                    }
                    // Remove all uploaded search stores
                    $response = $client->fileSearchStores()->list(pageSize: 10);
                    foreach ($response->fileSearchStores as $fileStore) {
                        $client->fileSearchStores()->delete($fileStore->name, force: true);
                        $this->info("Existing $fileStore->name ({$fileStore->displayName}) has been deleted");
                    }
                    break;
                default:
                    $this->info('No provider has been specified.');
                    break;
            }
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
