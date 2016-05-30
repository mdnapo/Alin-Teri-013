<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Jan',
            'reactie' => 'Wat een mooi artikel.',
            'geaccepteerd' => 1
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Peter',
            'reactie' => 'Bijzonder artikel, mooi om te lezen.',
            'geaccepteerd' => 1
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Annemarie',
            'reactie' => 'Heel informatief.',
            'geaccepteerd' => 1
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Gert',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Annie',
            'reactie' => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Gerard',
            'reactie' => 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.',
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Niels',
            'reactie' => 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.',
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Dajo',
            'reactie' => 'Nullam dictum felis eu pede mollis pretium. Integer tincidunt.',
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Jeroen',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Donne',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
        ]);

        App\Comment::create([
            'publication_id' => '1',
            'naam' => 'Roel',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
        ]);

        App\Comment::create([
            'publication_id' => '2',
            'naam' => 'Lars',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
            'geaccepteerd' => 1
        ]);

        App\Comment::create([
            'publication_id' => '2',
            'naam' => 'Niels',
            'reactie' => 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.',
            'geaccepteerd' => 1
        ]);

        App\Comment::create([
            'publication_id' => '2',
            'naam' => 'Dajo',
            'reactie' => 'Nullam dictum felis eu pede mollis pretium. Integer tincidunt.',
        ]);

        App\Comment::create([
            'publication_id' => '2',
            'naam' => 'Jeroen',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
        ]);

        App\Comment::create([
            'publication_id' => '2',
            'naam' => 'Donne',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
        ]);

        App\Comment::create([
            'publication_id' => '2',
            'naam' => 'Roel',
            'reactie' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.',
        ]);
    }
}
