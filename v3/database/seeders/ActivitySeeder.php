<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Lib\Csql;
use App\Models\ActivityModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityModel::create([
            "namaactivity" => "Balinese Traditional House",
            "seoactivity" => Str::slug('Balinese Traditional House'),
            "gambaractivity" => "galeri1.jpg",
            "keterangansingkat" => "There are 3 aspects that must be fulfilled: palemahan, pawongan, and parahyangan. If palemahan is the state in which the inhabitant and the surroundings of the home they live in have a positive relationship, then pawongan is the term used to describe the occupant of the home. Meanwhile, Parahyangan, refers to the bond between people and God",
            "keterangan" => "Balinese Traditional House
                Balinese traditional houses have the same concept as Tri Hita Karana, to brief to creating the harmony.
                There are 3 aspects that must be fulfilled: palemahan, pawongan, and parahyangan. If palemahan is the state in which the inhabitant and the surroundings of the home they live in have a positive relationship, then pawongan is the term used to describe the occupant of the home. Meanwhile, Parahyangan, refers to the bond between people and God.
                The Asta Kosala Kosali principles, which demand philosophy and meaning, were followed in the construction of this traditional Balinese home. Thus, Balinese builders will consider angles and directions when constructing a traditional home.
                Because according to Balinese beliefs, direction has an important meaning in the life of the Balinese tribe. What is considered the most holy or sacred is when you build a house in the direction of a mountain.
                Part of a traditional Balinese house <br />
                1. Angkul - angkul <br />
                The main entrance is in the form of a gate or similar to Candi Bentar. <br />
                2. Bale Dangin is a building that functions as a place for ceremonies related to humans, from birth to death. For example, Tujub bulanan ceremonies [7 months after birth] weddings, teeth cutting and death ceremonies. <br />
                3. Bale Daje [meten]. Built in the north. Usually used for older people, and used for wedding proposals. <br />
                4. Bale Dauh is used to receive the guest or used for gathering.<br />
                5. Bale Delod functions for kitchens and rooms.<br />
                6. Jineng or barn is used as a place to store grain.
                ",
        ]);

        ActivityModel::create([
            "namaactivity" => "The philosophy of pounding rice",
            "seoactivity" => Str::slug('The philosophy of pounding rice'),
            "gambaractivity" => "galeri2.jpg",
            "keterangansingkat" => "In Balinese tradition, pounding rice is called Ngoncang. In Balinese, Ngoncang comes from the word 'gaguncangan' which means boisterous. Based on how clearly or loudly the sound made while striking the pestle in the mortar is created.",
            "keterangan" => 'The philosophy of pounding rice
                Lesung [mortal] is a traditional stone or wood household device used for pounding rice, namely separating the rice husks into rice with alu - an upright wood or cylindrical structure.
                Before being pounded, rice needs to be completely dry in the sun. The idea is for the rice to come out without breaking and with the rice husk easily detached.
                In Balinese tradition, pounding rice is called Ngoncang. In Balinese, Ngoncang comes from the word "gaguncangan" which means boisterous. Based on how clearly or loudly the sound made while striking the pestle in the mortar is created.
                The Ngoncang tradition has existed since the 4th century, at the beginning of the arrival of Hinduism from India to Indonesia. in accordance with Tri Hita Karana concept. Ngoncang is a representation of harmony among people, God, other people, and the natural world.
                Rice is thought to represent the multipurpose body part of Dewi Sri, the Goddess of Fertility. Beginning with the rice"s husk, further parts of the plant can be used, such as the slightly rough skin (bran), rice bran"s epidermis, rice kernels, rice stalks (straw), and rice plant stems (damen/straw).
                Alu and lesung referred to as the linga yoni in mythology. Alu is Lingga symbol is represent he masculine aspect of creation, power, and energy.
                Lesung is yoni symbol represents the feminine principle, fertility, and the source of life. It is usually depicted as a circular base or platform that holds the linga, symbolizing the womb or the source from which life emerges.
                The yoni is often paired with the linga, symbolizing the unity and balance of male and female energies. Together, they represent the totality of existence and the creative process.
',
        ]);

        ActivityModel::create([
            "namaactivity" => "Loloh Cemcem",
            "seoactivity" => Str::slug('Loloh Cemcem'),
            "gambaractivity" => "galeri3.jpg",
            "keterangansingkat" => "“Loloh Cemcem” terbuat dari daun cemcem atau yang biasa disebut kedondong hutan, minuman ini memiliki cita rasa yang unik. Ada kumpulan rasa asam, asin, manis, pedas, dan juga sedikit kecut.
                Selain untuk menyegarkan tubuh, masyarakat sekitar percaya bahwa Loloh Cemcem juga berkhasiat mengobati panas dalam, melancarkan sembelit, dan bahkan bisa menurunkan tekanan darah. Meski memiliki cita rasa asam, loloh ini juga aman untuk penderita maag. Asalkan diminumnya tidak dalam keadaan perut kosong. Waktu terbaik menikmati loloh ini adalah dalam keadaan dingin.
            ",
            "keterangan" => "“Loloh Cemcem” terbuat dari daun cemcem atau yang biasa disebut kedondong hutan, minuman ini memiliki cita rasa yang unik. Ada kumpulan rasa asam, asin, manis, pedas, dan juga sedikit kecut.
                Selain untuk menyegarkan tubuh, masyarakat sekitar percaya bahwa Loloh Cemcem juga berkhasiat mengobati panas dalam, melancarkan sembelit, dan bahkan bisa menurunkan tekanan darah. Meski memiliki cita rasa asam, loloh ini juga aman untuk penderita maag. Asalkan diminumnya tidak dalam keadaan perut kosong. Waktu terbaik menikmati loloh ini adalah dalam keadaan dingin.
            ",
        ]);
    }
}
