<?php

use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    public function getPackageId($string)
    {
        $tmp = str_replace('-', '', $string);
        $packageId = intval($tmp) + 1;

        $partThree = substr(strval($packageId), -4);
        $partTwo = substr(strval($packageId), -7, 3);
        $partOne = substr(strval($packageId), -10, strlen(strval($packageId)) - 7);
        $partOne = intval($partOne) < 10 ? '0' . $partOne : $partOne;

        return $partOne . '-' . $partTwo . '-' . $partThree;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $defaultPackageId = '01-001-0000';

        for ($i = 0; $i <= 100; $i++):

            $packageId = $this->getPackageId($defaultPackageId);

            DB::table('packages')
                ->insert([
                    'name' => $faker->name,
                    'package_id' => $packageId,
                    'tracking_number' => rand(),
                    'date_received' => \Carbon\Carbon::now(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);

            $forCount = rand(1, 3);

            for ($j = 0; $j < $forCount; $j++) {
                DB::table('package_detail')
                    ->insert([
                        'name' => $faker->name,
                        'package_id' => $packageId,
                        'price' => rand(1, 1000000),
                        'qty' => rand(1, 1000),
                        'weight' => rand(1, 10000),
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
            }

            $defaultPackageId = $packageId;

        endfor;
    }
}
