<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\UploadedFile;
use Exception;
use Illuminate\Console\Command;
use Gemini;
use Gemini\Enums\FileState;
use Gemini\Enums\MimeType;
use Log;
use Storage;

/**
 * This command uploads file context to the AI from our posts Database.
 * 
 * @author Ale Mostajo <https://github.com/amostajo>
 * @version 1.0.0
 */
class UploadContextCommand extends Command
{
    /**
     * The name and signature of the console command.
     * @since 1.0.0
     * 
     * @command-arg    string {provider} Is the provider name.
     * @command-option string {f|format} File storage format (JSON|TXT).
     *
     * @var string
     */
    protected $signature = 'app:upload-context {provider} {--f|format=txt}';

    /**
     * The console command description.
     * @since 1.0.0
     *
     * @var string
     */
    protected $description = 'Uploads database records as context files to AI providers.';

    /**
     * Execute the console command.
     * @since 1.0.0
     */
    public function handle()
    {
        try {
            $options = [
                'format' => $this->option('format') ?? 'txt',
            ];
            switch ($this->argument('provider')) {
                case 'gemini':
                    $client = Gemini::client(config('services.gemini.key'));
                    // Check if the file already exists
                    $file = UploadedFile::where('provider', 'gemini')
                        ->where('key', 'posts')
                        ->first();
                    if ($file) {
                        Storage::delete($file->file_in_storage);
                        $client->fileSearchStores()->delete($file->provider_id);
                        $file->delete();
                        $this->info("Existing $file->provider_id has been deleted");
                    }
                    // Create file
                    $file_in_storage = 'posts.txt';
                    switch ($options['format']) {
                        case 'txt':
                            Storage::put($file_in_storage, implode("\r\n\r\n----------------------------\r\n\r\n", array_map(function($post) {
                                return 'Post #'.$post['id']."\n"
                                    . 'Tags: '.implode(',', $post['tags'])."\n"
                                    . 'Title: '.$post['title']."\n"
                                    . 'Text: '.preg_replace('/\<br\/\>/', "\r\n", $post['text']);
                            }, Post::get()->toArray())));
                            break;
                        case 'json':
                            $file_in_storage = 'posts.json';
                            Storage::put($file_in_storage, (string)Post::get());
                            break;
                    }
                    $filename = storage_path('app/private/'.$file_in_storage);
                    // Upload file
                    $fileSearchStore = $client->fileSearchStores()->create(
                        displayName: 'Trading card game data',
                    );
                    $response = $client->fileSearchStores()->upload(
                        storeName: $fileSearchStore->name,
                        filename: $filename,
                        mimeType: MimeType::TEXT_PLAIN,
                        displayName: 'Trading card game data',
                    );
                    $this->info('... Uploading to gemini....');
                    do {
                        sleep(2);
                    } while (!$response->done);
                    if ($response->error)
                        throw new Exception('Upload failed: '.$response->error);
                    UploadedFile::create([
                        'provider' => 'gemini',
                        'provider_id' => $fileSearchStore->name,
                        'key' => 'posts',
                        'filename' => $filename,
                    ]);
                    $this->info("File $filename uploaded successfully as $fileSearchStore->name");
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
