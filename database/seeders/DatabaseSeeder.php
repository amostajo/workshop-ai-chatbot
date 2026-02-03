<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Post::updateOrCreate(
            [
                'game' => 'One Piece Card Game',
                'title' => 'How to make swings in One Piece Card Game?',
            ], // Attributes to search by
            [
                'text' => 'You always want to force your opponent to spend his resources to protect his cards; the resources he may use are in-field blocker cards or counter cards (count events or character cards with counter values).<br/><br/>The more he uses resources, the fewer cards in hand he will have for the rest of the game giving you an advantage.<br/><br/>Should I make a swing with a power greater than my target?<br/><br/>It depends. If your target is the opponent\'s leader card or a very important character, then probably you want to secure the K.O or force your opponent to use more than 1 resource to defend.<br/><br/>Remember that in the game, there are only two character counter values, +1000 (also known as 1k counter) and +2000 (also known as 2k counter).<br/><br/>Unless your opponent has an active blocker character on the field, if you want to ensure your swing, you want to attack with a power equal to or over your target\'s power + 2000.<br/><br/>If your opponent has an active blocker card, if you want to ensure your swing, you want to attack with a power equal to or over your opponent\'s blocker card power + 2000.',
                'tags' => ['swings', 'attacks', 'swing', 'optcg'],
            ] // Values to update or create with
        );
        Post::updateOrCreate(
            [
                'game' => 'One Piece Card Game',
                'title' => 'What is a swing?',
            ], // Attributes to search by
            [
                'text' => 'A "swing" is a game term used to reference when you attack your opponent during your "Main" turn phase. Remember that an individual attack may start a battle that ends up with multiple steps: when attacking effects resolution, on opponents\' attack resolution, counter step, blocking step, and finally the damage evaluation.<br/><br/>The term "Swings" refers to multiple attacks done during your "Main" turn phase.<br/><br/>When making swings, the first thing you want to do is match the power level of your attacking card with your opponent\'s, because in One Piece Card Game, making an attack equal to or greater than the target\'s attack power is enough to force your opponent to use his resources to defend it. If your target has a greater power than the one you attack with, then you will lose the battle.',
                'tags' => ['swings', 'attacks', 'swing', 'optcg'],
            ] // Values to update or create with
        );
        Post::updateOrCreate(
            [
                'game' => 'One Piece Card Game',
                'title' => 'Card colors',
            ], // Attributes to search by
            [
                'text' => 'The One Piece Card Game offers 6 colors: red, green, blue, purple, black, and yellow.<br/><br/>Card colors serve two purposes.<br/><br/>The first purpose is to determine which cards can be added to your deck, since every deck is built towards a selected leader card, and this card has a specific color or colors. You cannot build a deck with colors that do not match your leader card.<br/><br/>The second purpose is to define a play style. The game designers have defined a role and a play style for each color:<br/><br/>The red color is associated with aggro play style, and plays with the power level of cards.<br/><br/>The green color is associated with board-control play style, and plays with the state of the cards on the board.<br/><br/>The blue color is associated with board-ramp play style, and plays with the cards (in your hand, in the don area, in the cost area, in your deck).<br/><br/>The purple color is associated with a technical play style, and plays with your DON cards.<br/><br/>The black color is associated with a board-control play style, and plays with the cost of cards or the trash.<br/><br/>The yellow color is associated with a life-control play style, and plays with the life cards.',
                'tags' => ['colors', 'play style', 'styles', 'optcg'],
            ] // Values to update or create with
        );
    }
}
