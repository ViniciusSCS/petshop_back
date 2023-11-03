<?php

namespace Database\Seeders;

use App\Models\Raca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RacaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $racas = [
            [
                'especie_id' => 4,
                'descricao' => 'Raça não Definida (RND)',
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Afghan Hound',
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Akita'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Akita Americano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'American Bully'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'American Pit Bull Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'American Staffordshire Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Australian Cattle Dog'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Australian Shepherd'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Basenji'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Basset hound'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Beagle'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Beauceron'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bernese Mountain Dog'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bichon Frisé'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bichon Havanês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bloodhound'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Border Collie'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Borzoi'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Boston Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bouvier de Flandres'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Boxer'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Braco Alemão de Pelo Curto'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bulldog Americano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Buldogue Campeiro'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Buldogue Francês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bulldog Inglês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bulmastiff'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Bull Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Cairn Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Cane Corso Italiano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Cavalier King Charles Spaniel'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Chihuahua'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Chinese Crested Dog'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Chow Chow'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Cocker Spaniel Americano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Cocker Spaniel Inglês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Collie'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Dachshund (Teckel)'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Dálmata'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Dobermann'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Dogo Argentino'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Dog Alemão'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Dog de Bordeaux'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Fila Brasileiro'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Fox Terrier Pelo Duro'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Fox Terrier Pelo Liso'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Golden Retriever'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Greyhound'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Husky Siberiano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Jack Russell Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Keeshond'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Kerry Blue Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Komondor'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Kuvasz'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Lhasa Apso'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Maltês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Mastiff'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Mastino Napoletano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Old English Sheepdog'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pastor Alemão'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pastor Branco Suíço'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pastor Belga Groenandael'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pastor Belga Malinois'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pastor Belga Tervuren'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pastor de Shetland'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pastor Maremano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pequinês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pinscher'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pointer Inglês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Poodle Toy'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Pug'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Puli'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Retriever do Labrador'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Rhodesian Ridgeback'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Rottweiler'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Samoeida'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'São Bernardo'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Schipperke'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Schnauzer Gigante'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Schnauzer Miniatura'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Schnauzer Standard'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Scottish Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Setter Inglês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Setter Irlandês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Shar Pei'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Shiba'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Shih Tzu'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Skye Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Spitz Alemão Anão (Pomerânia)'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Springer Spaniel Inglês'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Terra Nova'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Terrier Brasileiro'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Terrier Tibetano'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Weimaraner'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Welsh Corgi Cardigan'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Welsh Corgi Pembroke'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'West Highland White Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Whippet'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Yorkshire Terrier'
            ],
            [
                'especie_id' => 1,
                'descricao' => 'Wolfhound Irlandês'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Abissínio'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'American Shorthair'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Angorá'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Azul Russo'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Bengal'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Brazilian Shorthair'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'British Shorthair'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Burmese'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Chartreux'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Cornish Rex'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Devon Rex'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Egyptian Mau'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'European Shorthair'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Exótico'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Himalaio'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Maine Coon'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Munchkin'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Norwegian Forest'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Oriental'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Persa'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Ragdoll'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Sagrado da Birmânia'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Savannah'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Scottish Fold'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Siamês'
            ],
            [
                'especie_id' => 2,
                'descricao' => 'Sphynx'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Andaluz'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Campolina'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Cavalo Árabe'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Lusitano'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Mangalarga'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Mangalarga Marchador'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Puro Sangue Inglês'
            ],
            [
                'especie_id' => 5,
                'descricao' => 'Quarto de Milha'
            ],
        ];

        foreach ($racas as $raca){
            Raca::UpdateOrCreate($raca, $raca);
        }
    }
}
