<?php

namespace Database\Factories;

use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sport>
 */
class SportFactory extends Factory
{
    protected $tabSports = array('Athlétisme', 'Aviron', 'Badminton', 'Basketball', 'Basketball 3×3', 'Boxe', 'Canoë', 'Sprint', 'Canoë-kayak', 'Slalom', 'Cyclisme sur piste',
        'Cyclisme sur route', 'BMX freestyle', 'BMX racing', 'Mountain bike (VTT)', 'Escrime', 'Football', 'Golf', 'Gymnastique artistique',
        'Gymnastique rythmique', 'Trampoline', 'Haltérophilie', 'Handball', 'Hockey', 'Judo', 'Lutte', 'Pentathlon moderne', 'Rugby', 'Natation',
        'Natation artistique', 'Natation marathon', 'Plongeon', 'Waterpolo', 'Sports équestres', 'Taekwondo', 'Tennis', 'Tennis de table', 'Tir',
        'Tir à l’arc', 'Triathlon', 'Voile', 'Volleyball', 'Volleyball de plage', 'Breaking', 'Escalade sportive', 'Skateboard', 'Surf');

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $starts_at = $this->faker->dateTimeInInterval(
          $startDate = '+ 6 months',
          $interval = '+17 days'
        );

        $createAt = $this->faker->dateTimeInInterval(
            $startDate = '-6 months',
            $interval = '+ 180 days',
        );

        $name = $this->faker->unique->randomElement($this->tabSports);

        $users_id = User::all()->pluck('id');
        return [
            'nom' => $name,
            'description' => $this->faker->paragraph,
            'annee_ajout' => $this->faker->year,
            'nb_disciplines' => $this->faker->numberBetween(0,10),
            'nb_epreuves' => $this->faker->numberBetween(0,5),
            'date_debut' => $starts_at,
            'date_fin' => $this->faker->dateTimeInInterval(
                $starts_at,
                $interval = '+ 2 days'),
            'user_id' =>$this->faker->randomElement($users_id),
            'url_image' => 'default_image.jpg',
            'created_at' => $createAt,
            'updated_at' => $this->faker->dateTimeInInterval(
                $startDate,
                $interval = $createAt->diff(new DateTime('now'))->format("%R%a days"),
                )
        ];
    }
}
