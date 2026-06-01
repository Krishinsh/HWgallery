<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $lietotajaLoma = Role::firstOrCreate(
            ['name' => 'user'],
            ['description' => 'Reģistrēts lietotājs — pārvalda savu kolekciju un profilu']
        );

        $adminLoma = Role::firstOrCreate(
            ['name' => 'admin'],
            ['description' => 'Administrators — pārvalda jebkuru saturu un lietotājus']
        );

        User::firstOrCreate(
            ['email' => 'admin@hwcollect.lv'],
            [
                'nickname' => 'admin',
                'password' => Hash::make('admin1234'),
                'role_id'  => $adminLoma->id,
            ]
        );

        $kristians = User::firstOrCreate(
            ['email' => 'kristians@hwcollect.lv'],
            [
                'nickname' => 'kristians',
                'password' => Hash::make('parole1234'),
                'role_id'  => $lietotajaLoma->id,
            ]
        );

        $masinas = [
            ['model' => "'17 Acura NSX",                                    'year' => 2018, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'17_Acura_NSX"],
            ['model' => "Custom '01 Acura Integra GSR",                     'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Custom_'01_Acura_Integra_GSR"],
            ['model' => "'90 Acura NSX",                                    'year' => 2019, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'90_Acura_NSX"],
            ['model' => 'Honda Civic Custom',                               'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Honda_Civic_Custom"],
            ['model' => 'Honda S2000',                                      'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Honda_S2000"],
            ['model' => 'Subaru WRX STI',                                   'year' => 2016, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Subaru_WRX_STI"],
            ['model' => 'Toyota Supra',                                     'year' => 2019, 'series' => 'HW Speed Graphics',  'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Toyota_Supra"],
            ['model' => "'20 Toyota GR Supra",                              'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'20_Toyota_GR_Supra"],
            ['model' => "'95 Mazda RX-7 (Project µ)",                       'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'95_Mazda_RX-7_(Project_µ)"],
            ['model' => 'LB-Silhouette Works GT Nissan 35GT-RR Ver.2 (Red)','year' => 2022, 'series' => '2022 HW J-Imports', 'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB-Silhouette_Works_GT_Nissan_35GT-RR_Ver.2"],
            ['model' => 'LB-Silhouette Works GT Nissan 35GT-RR Ver.2 (White)','year' => 2022,'series' => '2022 HW J-Imports','color' => 'Balta',        'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB-Silhouette_Works_GT_Nissan_35GT-RR_Ver.2"],
            ['model' => 'LB Super Silhouette Nissan Silvia S15',            'year' => 2023, 'series' => 'HW Drift',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB_Super_Silhouette_Nissan_Silvia_S15"],
            ['model' => 'Ford GT40',                                        'year' => 2020, 'series' => 'HW Race Day',        'color' => 'Nav norādīta', 'description' => "TH/STH: Jā (STH)\nhttps://hotwheels.fandom.com/wiki/Ford_GT40"],
            ['model' => "'91 GMC Syclone",                                  'year' => 2018, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'91_GMC_Syclone"],
            ['model' => "'99 Ford F-150 SVT Lightning",                     'year' => 2019, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'99_Ford_F-150_SVT_Lightning"],
            ['model' => 'Dodge Van',                                        'year' => 2012, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Dodge_Van"],
            ['model' => 'Proton Saga',                                      'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Proton_Saga"],
            ['model' => 'Porsche 911 Turbo Cabriolet',                      'year' => 2024, 'series' => 'Factory Fresh',      'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Porsche_911_Turbo_Cabriolet"],
            ['model' => 'Porsche Taycan Turbo S',                           'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Porsche_Taycan_Turbo_S"],
            ['model' => 'Porsche 911 Carrera T',                            'year' => 2023, 'series' => 'Factory Fresh',      'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Porsche_911_Carrera_T"],
            ['model' => 'Porsche 911 TS',                                   'year' => 2023, 'series' => 'HW Speed Graphics',  'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Porsche_911_GT3"],
            ['model' => 'Porsche 935 (Red)',                                'year' => 2019, 'series' => "HW The '80s",        'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Porsche_935"],
            ['model' => 'Batmobile',                                        'year' => 2020, 'series' => 'Batman',             'color' => 'Melna',        'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Batmobile"],
            ['model' => 'Back to the Future Time Machine',                  'year' => 2011, 'series' => 'HW Screen Time',     'color' => 'Nav norādīta', 'description' => "TH/STH: Jā (STH)\nhttps://hotwheels.fandom.com/wiki/Back_to_the_Future_Time_Machine"],
            ['model' => "'96 Dodge Viper GTS",                              'year' => 2019, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'96_Dodge_Viper_GTS"],
            ['model' => "'64 Impala (50th Anniversary)",                    'year' => 2018, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'64_Impala_(50th_Anniversary)"],
            ['model' => 'Ford GT40 (Blue)',                                 'year' => 2023, 'series' => 'HW Race Day',        'color' => 'Zila',         'description' => "TH/STH: Jā (STH)\nhttps://hotwheels.fandom.com/wiki/Ford_GT40"],
            ['model' => 'Lotus Emira',                                      'year' => 2023, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Lotus_Emira"],
            ['model' => 'Porsche 911 Turbo Cabriolet (964, Maroon)',        'year' => 2024, 'series' => 'Factory Fresh',      'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Porsche_911_Turbo_Cabriolet"],
            ['model' => 'Porsche 911 Carrera T (Grey)',                     'year' => 2023, 'series' => 'Factory Fresh',      'color' => 'Pelēka',       'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Porsche_911_Carrera_T"],
            ['model' => "'89 Mercedes-Benz 560 SEC AMG",                    'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'89_Mercedes-Benz_560_SEC_AMG"],
            ['model' => 'BMW 2002',                                         'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/BMW_2002"],
            ['model' => 'BMW 635 CSi',                                      'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/BMW_635_Csi"],
            ['model' => 'BMW M3 Wagon',                                     'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/BMW_M3_Wagon"],
            ['model' => 'Volvo 240 Drift Wagon',                            'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Volvo_240_Drift_Wagon"],
            ['model' => 'Volvo 850 Estate',                                 'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Volvo_850_Estate"],
            ['model' => 'Ferrari SF90 Stradale',                            'year' => 2023, 'series' => 'Mainline',           'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Ferrari_SF90_Stradale"],
            ['model' => "LB-Works Lamborghini Huracán Coupé",               'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB-Works_Lamborghini_Huracán_Coupé"],
            ['model' => "'94 Bugatti EB110 SS",                             'year' => 2022, 'series' => 'HW Turbo',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'94_Bugatti_EB110_SS"],
            ['model' => 'McLaren F1 (Red)',                                 'year' => 2020, 'series' => 'HW Exotics',         'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/McLaren_F1"],
            ['model' => 'Ferrari SF90 Stradale (Dark Grey)',                'year' => 2023, 'series' => 'Mainline',           'color' => 'Pelēka',       'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Ferrari_SF90_Stradale"],
            ['model' => "LB-Works Lamborghini Huracán Coupé (Silver)",      'year' => 2022, 'series' => 'Mainline',           'color' => 'Sudraba',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB-Works_Lamborghini_Huracán_Coupé"],
            ['model' => "'94 Bugatti EB110 SS (Silver)",                    'year' => 2022, 'series' => 'HW Turbo',           'color' => 'Sudraba',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'94_Bugatti_EB110_SS"],
            ['model' => 'McLaren F1 (Red) 2',                               'year' => 2020, 'series' => 'HW Exotics',         'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/McLaren_F1"],
            ['model' => 'Lancia Delta Integrale',                           'year' => 2021, 'series' => 'Baja Blazers',        'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Lancia_Delta_Integrale"],
            ['model' => 'Alfa Romeo GTV6 3.0',                              'year' => 2023, 'series' => 'Rally Champs',        'color' => 'Nav norādīta', 'description' => "TH/STH: Jā (STH)\nhttps://hotwheels.fandom.com/wiki/Alfa_Romeo_GTV6_3.0"],
            ['model' => 'Jaguar XE SV Project 8',                           'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Jaguar_XE_SV_Project_8"],
            ['model' => 'Ramen Express',                                    'year' => 2023, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Ramen_Express"],
            ['model' => 'Mercedes-Benz 500 E',                              'year' => 2020, 'series' => 'Factory Fresh',      'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Mercedes-Benz_500_E"],
            ['model' => "'89 Mercedes-Benz 560 SEC AMG (Blue)",             'year' => 2022, 'series' => 'Mainline',           'color' => 'Zila',         'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'89_Mercedes-Benz_560_SEC_AMG"],
            ['model' => 'BMW 2002 (Blue)',                                   'year' => 2021, 'series' => 'Mainline',           'color' => 'Zila',         'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/BMW_2002"],
            ['model' => 'BMW 635 CSi (Orange)',                             'year' => 2022, 'series' => 'Mainline',           'color' => 'Oranža',       'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/BMW_635_CSi"],
            ['model' => 'BMW M3 Wagon (Green Castrol)',                     'year' => 2022, 'series' => 'Mainline',           'color' => 'Zaļa',         'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/BMW_M3_Wagon"],
            ['model' => "Custom '01 Acura Integra GSR (Black)",             'year' => 2022, 'series' => 'Mainline',           'color' => 'Melna',        'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Custom_'01_Acura_Integra_GSR"],
            ['model' => "'90 Acura NSX (White)",                            'year' => 2019, 'series' => 'Mainline',           'color' => 'Balta',        'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'90_Acura_NSX"],
            ['model' => 'Honda Civic Custom (Blue)',                        'year' => 2022, 'series' => 'Mainline',           'color' => 'Zila',         'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Honda_Civic_Custom"],
            ['model' => 'Honda S2000 (Red)',                                'year' => 2020, 'series' => 'Mainline',           'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Honda_S2000"],
            ['model' => 'Honda Civic Si',                                   'year' => 2021, 'series' => 'HW J-Imports',       'color' => 'Nav norādīta', 'description' => "TH/STH: Jā (STH)\nhttps://hotwheels.fandom.com/wiki/Honda_Civic_Si"],
            ['model' => 'Subaru WRX STI (Dark)',                            'year' => 2016, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Subaru_WRX_STI"],
            ['model' => 'Toyota Supra (Dark Green)',                        'year' => 2019, 'series' => 'HW Speed Graphics',  'color' => 'Zaļa',         'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Toyota_Supra"],
            ['model' => "'20 Toyota GR Supra (Yellow)",                     'year' => 2021, 'series' => 'Mainline',           'color' => 'Dzeltena',     'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'20_Toyota_GR_Supra"],
            ['model' => "'95 Mazda RX-7 (Blue)",                            'year' => 2021, 'series' => 'Mainline',           'color' => 'Zila',         'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'95_Mazda_RX-7"],
            ['model' => 'Mazda RX-7',                                       'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Mazda_RX-7"],
            ['model' => 'LB-Silhouette Works GT Nissan 35GT-RR (Red)',      'year' => 2022, 'series' => '2022 HW J-Imports',  'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB-Silhouette_Works_GT_Nissan_35GT-RR_Ver.2"],
            ['model' => 'LB-Silhouette Works GT Nissan 35GT-RR (White)',    'year' => 2022, 'series' => '2022 HW J-Imports',  'color' => 'Balta',        'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB-Silhouette_Works_GT_Nissan_35GT-RR_Ver.2"],
            ['model' => 'LB Super Silhouette Nissan Silvia S15 #23',        'year' => 2023, 'series' => 'HW Drift',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/LB_Super_Silhouette_Nissan_Silvia_S15"],
            ['model' => 'Nissan Silvia S13 (Red)',                          'year' => 2020, 'series' => 'Mainline',           'color' => 'Sarkana',      'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Nissan_Silvia_S13_(Red)"],
            ['model' => 'Nissan Silvia S13 (Blue)',                         'year' => 2020, 'series' => 'Mainline',           'color' => 'Zila',         'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Nissan_Silvia_S13_(Blue)"],
            ['model' => 'Honda Civic Si (White)',                           'year' => 2021, 'series' => 'HW J-Imports',       'color' => 'Balta',        'description' => "TH/STH: Jā (STH)\nhttps://hotwheels.fandom.com/wiki/Honda_Civic_Si"],
            ['model' => "'00 Honda Civic Type R (EK9)",                     'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'00_Honda_Civic_Type_R_(EK9)"],
            ['model' => "'98 Honda Prelude",                                'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'98_Honda_Prelude"],
            ['model' => '1985 Honda CR-X',                                  'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/1985_Honda_CR-X"],
            ['model' => 'Honda S800 Racing',                                'year' => 2022, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Honda_S800_Racing"],
            ['model' => "'89 Mazda Savanna RX-7 FC3S",                      'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'89_Mazda_Savanna_RX-7_FC3S"],
            ['model' => "'15 Mazda MX-5 Miata",                             'year' => 2018, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'15_Mazda_MX-5_Miata"],
            ['model' => "'91 Mazda MX-5 Miata",                             'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'91_Mazda_MX-5_Miata"],
            ['model' => 'Mazda RX-3',                                       'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Mazda_RX-3"],
            ['model' => 'Nissan Silvia S13',                                'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Nissan_Silvia_S13"],
            ['model' => 'Nissan 300ZX Twin Turbo',                          'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Nissan_300ZX_Twin_Turbo"],
            ['model' => 'Nissan Skyline 2000 GT-R',                        'year' => 2019, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/Nissan_Skyline_2000_GT-R"],
            ['model' => "'70 Toyota Celica",                                'year' => 2021, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'70_Toyota_Celica"],
            ['model' => "'71 Datsun 510",                                   'year' => 2020, 'series' => 'Mainline',           'color' => 'Nav norādīta', 'description' => "TH/STH: Nav\nhttps://hotwheels.fandom.com/wiki/'71_Datsun_510"],
        ];

        foreach ($masinas as $m) {
            Car::firstOrCreate(
                ['user_id' => $kristians->id, 'model' => $m['model']],
                $m
            );
        }
    }
}
