<?php

namespace App\Ai\Agents;

use App\Models\User;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Promptable;
use Laravel\Ai\Providers\Tools\WebSearch;
use Illuminate\Support\Str;
use Stringable;

/**
 * TCG Agent
 * 
 * @author Ale Mostajo <https://github.com/amostajo>
 * @version 1.0.0
 */
class TcgAssitant implements Agent, Conversational, HasTools
{
    use Promptable;

    public function __construct(
        public ?User $user,
        public ?string $language = 'English'
    ) {
        // @todd
    }

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return Str::replace(
            '{language}',
            $this->language,
            'You are a TCG (Trading Card Game) expert and SEO expert'
                . ', "hero" refers to a section in a website that highlights its main purpose'
                . ', conversation is always in {language}'
                . ', answer:'
        );
    }

    /**
     * Get the list of messages comprising the conversation so far.
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [
            // new WebSearch,
        ];
    }
}
