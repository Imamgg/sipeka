<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $classXIPA = DB::table('classes')->where('class_name', 'X IPA')->first();
        $classXIPS = DB::table('classes')->where('class_name', 'X IPS')->first();
        $classXIIPA = DB::table('classes')->where('class_name', 'XI IPA')->first();
        $classXIIPS = DB::table('classes')->where('class_name', 'XI IPS')->first();
        $classXIIIPA = DB::table('classes')->where('class_name', 'XII IPA')->first();
        $classXIIIPS = DB::table('classes')->where('class_name', 'XII IPS')->first();

        if (!$classXIPA || !$classXIPS || !$classXIIPA || !$classXIIPS || !$classXIIIPA || !$classXIIIPS) {
            $this->command->error('Salah satu kelas tidak ditemukan. Silakan jalankan ClassesSeeder terlebih dahulu.');
            return;
        }

        $this->command->info('Memasukkan data siswa kelas X IPA, X IPS, XI IPA, XI IPS, XII IPA, dan XII IPS...');

        // Data siswa Kelas X IPA
        $studentsXIPA = [
            ['nis' => '13468', 'nisn' => '3088160043', 'name' => 'ABHIEM DIYA ADIN', 'gender' => 'M'],
            ['nis' => '13473', 'nisn' => '84772742', 'name' => 'ADITYA FIRMANSYAH', 'gender' => 'M'],
            ['nis' => '13483', 'nisn' => '3095818915', 'name' => 'AHMAD PASYA ALKHALIFI', 'gender' => 'M'],
            ['nis' => '13492', 'nisn' => '92087197', 'name' => 'ALBARI TSAQIF PUTRA PRASTYO', 'gender' => 'M'],
            ['nis' => '13502', 'nisn' => '92213585', 'name' => 'ALYA ADRIANA APRILIARINI', 'gender' => 'F'],
            ['nis' => '13511', 'nisn' => '3084003660', 'name' => 'ANDIKA AJI LUKMAWAN', 'gender' => 'M'],
            ['nis' => '13513', 'nisn' => '93465280', 'name' => 'ANGEL LOLITA', 'gender' => 'F'],
            ['nis' => '13534', 'nisn' => '94289714', 'name' => 'ATHALIA KASIH PERMATA', 'gender' => 'F'],
            ['nis' => '13541', 'nisn' => '92825918', 'name' => 'AURELLE TESSALONICA LAYUK', 'gender' => 'F'],
            ['nis' => '13547', 'nisn' => '85587987', 'name' => 'AVICENA RAKA SANTOSO', 'gender' => 'M'],
            ['nis' => '13571', 'nisn' => '81277551', 'name' => 'CALISTA RAHMA SHAKIRA', 'gender' => 'F'],
            ['nis' => '13572', 'nisn' => '96689541', 'name' => 'CALLISTA CHERYL VINDYAN PUTRI', 'gender' => 'F'],
            ['nis' => '13575', 'nisn' => '92243622', 'name' => 'CANTIKA NARAYA ANDINI', 'gender' => 'F'],
            ['nis' => '13586', 'nisn' => '95629579', 'name' => 'DAKSA SAMARATUNGGA', 'gender' => 'M'],
            ['nis' => '13608', 'nisn' => '3094465698', 'name' => 'ELA NURLATIFAH', 'gender' => 'F'],
            ['nis' => '13615', 'nisn' => '87213310', 'name' => 'EVO LANZHIO', 'gender' => 'M'],
            ['nis' => '13627', 'nisn' => '86222472', 'name' => 'FANDY FITRIYANTO', 'gender' => 'M'],
            ['nis' => '13647', 'nisn' => '89572963', 'name' => 'FRANSISCA MEGADENA MAHARANI', 'gender' => 'F'],
            ['nis' => '13657', 'nisn' => '85842253', 'name' => 'GRACIA KARUNA JATI', 'gender' => 'F'],
            ['nis' => '13664', 'nisn' => '88955437', 'name' => 'HIZKIA YOEL SAVERIO', 'gender' => 'M'],
            ['nis' => '13679', 'nisn' => '93920684', 'name' => 'JESSUA DIAN PERDANA', 'gender' => 'M'],
            ['nis' => '13680', 'nisn' => '98889875', 'name' => 'JETHRO ATA ALVAREAN', 'gender' => 'M'],
            ['nis' => '13686', 'nisn' => '84169640', 'name' => 'KARIN VANESSA KRISDIVA SIBURIAN', 'gender' => 'F'],
            ['nis' => '13689', 'nisn' => '95131650', 'name' => 'KEENAN AYUDY SILOAM', 'gender' => 'F'],
            ['nis' => '13714', 'nisn' => '85244831', 'name' => 'LISA VANIA ANGELOVE', 'gender' => 'F'],
            ['nis' => '13719', 'nisn' => '89260811', 'name' => 'M. FATKHUR ROZIQ', 'gender' => 'M'],
            ['nis' => '13737', 'nisn' => '3098172193', 'name' => 'MOCHAMMAD DARWIS AL HABZIN', 'gender' => 'M'],
            ['nis' => '13759', 'nisn' => '3082646295', 'name' => 'MUHAMMAD RUSLI BUSONO', 'gender' => 'M'],
            ['nis' => '13784', 'nisn' => '81055073', 'name' => 'NATASYA SEPFIRA RAMADHANI SOEGIHARTO', 'gender' => 'F'],
            ['nis' => '13785', 'nisn' => '88810880', 'name' => 'NATASYAUL MAULIDAH PUTRI', 'gender' => 'F'],
            ['nis' => '13799', 'nisn' => '84069409', 'name' => 'NEVAN ALEA GRACIAN', 'gender' => 'M'],
            ['nis' => '13850', 'nisn' => '91165150', 'name' => 'SAFIRA TIARA CITRA LARASATI', 'gender' => 'F'],
            ['nis' => '13869', 'nisn' => '92668530', 'name' => 'SUARDANA JAYA WIKRAMA', 'gender' => 'M'],
            ['nis' => '13889', 'nisn' => '86631293', 'name' => 'WINONA LAKEISHA TOBING', 'gender' => 'F'],
            ['nis' => '13892', 'nisn' => '88330910', 'name' => 'YOVITA AURA ANDRIANI', 'gender' => 'F'],
        ];

        // Data siswa Kelas X IPS
        $studentsXIPS = [
            ['nis' => '13469', 'nisn' => '86003827', 'name' => 'ACHMAD DANISH LUTFIYANTO', 'gender' => 'M'],
            ['nis' => '13486', 'nisn' => '88761737', 'name' => 'AIRA RATNAMA ANAKYA', 'gender' => 'F'],
            ['nis' => '13550', 'nisn' => '97842961', 'name' => 'AZELIA CAESA TERTIA BANNERINGGI', 'gender' => 'F'],
            ['nis' => '13555', 'nisn' => '89861943', 'name' => 'BALQIS ALMIRA FAIRUZ', 'gender' => 'F'],
            ['nis' => '13566', 'nisn' => '97923529', 'name' => 'BLANCHE ODELIA CHARITY ARIANI', 'gender' => 'F'],
            ['nis' => '13576', 'nisn' => '3080490281', 'name' => 'CANTIKA TRI MUAD FRIDA', 'gender' => 'F'],
            ['nis' => '13591', 'nisn' => '81634782', 'name' => 'DAVID YUDISTIRA ARKASON', 'gender' => 'M'],
            ['nis' => '13595', 'nisn' => '86682477', 'name' => 'DEVINA DWINTA SYAHPUTRI', 'gender' => 'F'],
            ['nis' => '13612', 'nisn' => '98493515', 'name' => 'ELYANA NAYSHILLA HENDRIYANA', 'gender' => 'F'],
            ['nis' => '13904', 'nisn' => '87004858', 'name' => 'ERICK BINTANG JALASENA', 'gender' => 'M'],
            ['nis' => '13616', 'nisn' => '85519938', 'name' => 'EVORIUS SERAFIM NOVIANTO', 'gender' => 'M'],
            ['nis' => '13632', 'nisn' => '84634570', 'name' => 'FARDHAN MAULANA NOR ISLAMI', 'gender' => 'M'],
            ['nis' => '13642', 'nisn' => '95099062', 'name' => 'FEBRIAN IMANUEL HETI PRATAMA', 'gender' => 'M'],
            ['nis' => '13649', 'nisn' => '83068389', 'name' => 'GADIZA PUTRI SETIANTI', 'gender' => 'F'],
            ['nis' => '13662', 'nisn' => '86802819', 'name' => 'HISYAM SUJA SONJAYA', 'gender' => 'M'],
            ['nis' => '13663', 'nisn' => '93952107', 'name' => 'HIZKIA LANCANA ARMADHANY', 'gender' => 'M'],
            ['nis' => '13665', 'nisn' => '95489618', 'name' => 'I MADE MANDALA MURANO WIBAWA', 'gender' => 'M'],
            ['nis' => '13666', 'nisn' => '92554778', 'name' => 'I MADE MUDA PUJANA', 'gender' => 'M'],
            ['nis' => '13675', 'nisn' => '92094390', 'name' => 'JASMINE SHAFIRA OKTADIANTY', 'gender' => 'F'],
            ['nis' => '13678', 'nisn' => '99171044', 'name' => 'JESSEN ANGKASAWAN SUPRASETYO PUTRA', 'gender' => 'M'],
            ['nis' => '13688', 'nisn' => '99947063', 'name' => 'KAYRA ESTRELA FRANSISKA PANDE', 'gender' => 'F'],
            ['nis' => '13694', 'nisn' => '87315024', 'name' => 'KEYFITRAH CAESARY NUR FATIHAH', 'gender' => 'F'],
            ['nis' => '13710', 'nisn' => '91162191', 'name' => 'LAURA BENITA YALAVENIA', 'gender' => 'F'],
            ['nis' => '13716', 'nisn' => '93640103', 'name' => 'LYDIA ANINDYTA VATONI', 'gender' => 'F'],
            ['nis' => '13725', 'nisn' => '88730687', 'name' => 'MARCELLO JOVAN SIMBOLON', 'gender' => 'M'],
            ['nis' => '13728', 'nisn' => '96235913', 'name' => 'MAUREN SARLIN ADELINA RISSI', 'gender' => 'F'],
            ['nis' => '13730', 'nisn' => '91355213', 'name' => 'MEIRINANDA ALMIRA PRASETYA', 'gender' => 'F'],
            ['nis' => '13760', 'nisn' => '87829245', 'name' => 'MUHAMMAD THORIQ FADILLAH', 'gender' => 'M'],
            ['nis' => '13773', 'nisn' => '91611497', 'name' => 'NADINENT EDUERDA KARINAYA ANANDA', 'gender' => 'F'],
            ['nis' => '13786', 'nisn' => '97286569', 'name' => 'NATHANAEL HENDI PUTRA', 'gender' => 'M'],
            ['nis' => '13801', 'nisn' => '86356041', 'name' => 'NICKY JONATHAN PRATAMA', 'gender' => 'M'],
            ['nis' => '13805', 'nisn' => '82749500', 'name' => 'NOEL TYAGAPUTRA AGNAWAN', 'gender' => 'M'],
            ['nis' => '13827', 'nisn' => '92963312', 'name' => 'RAGIL NUR MUHAMMAD MUTTAQIIN', 'gender' => 'M'],
            ['nis' => '13852', 'nisn' => '81447552', 'name' => 'SALWA RAHMATUL UMMAH', 'gender' => 'F'],
            ['nis' => '13875', 'nisn' => '92462590', 'name' => 'TANSYAH I\'ZAZ SETYAGAMA', 'gender' => 'M'],
            ['nis' => '13896', 'nisn' => '82619604', 'name' => 'ZAKY PASHA RAMADHAN', 'gender' => 'M'],
            ['nis' => '13897', 'nisn' => '97720423', 'name' => 'ZALFA ALMIRA', 'gender' => 'F'],
        ];

        // Data siswa Kelas XI IPA
        $studentsXIIPA = [
            ['nis' => '13023', 'nisn' => '0087990454', 'name' => 'ACHMAD FIRDAUS WIRAJAYA', 'gender' => 'M'],
            ['nis' => '13026', 'nisn' => '0088806595', 'name' => 'ADELAIDE FARIZA PRAMESTHY', 'gender' => 'F'],
            ['nis' => '13045', 'nisn' => '0084545442', 'name' => 'ALAMANDA DAFI', 'gender' => 'F'],
            ['nis' => '13055', 'nisn' => '0076142996', 'name' => 'ALIVA OKTIANA LEVI', 'gender' => 'F'],
            ['nis' => '13063', 'nisn' => '0084099609', 'name' => 'ALYA SYAUBALBAHA', 'gender' => 'F'],
            ['nis' => '13076', 'nisn' => '0077531645', 'name' => 'ANINDYA FIRDAUSA NARVITA PUTRI', 'gender' => 'F'],
            ['nis' => '13085', 'nisn' => '0073640761', 'name' => 'AQILLA SALSABILA PRAMESWARI', 'gender' => 'F'],
            ['nis' => '13095', 'nisn' => '0077667659', 'name' => 'ASHA YUNIAR SAFITRI', 'gender' => 'F'],
            ['nis' => '13106', 'nisn' => '0086045757', 'name' => 'AURELYA PUTRI CAHYAVANI', 'gender' => 'F'],
            ['nis' => '13114', 'nisn' => '0082054440', 'name' => 'BIRU NANDI NERPHAMAHESI', 'gender' => 'F'],
            ['nis' => '13121', 'nisn' => '0072790416', 'name' => 'CHANDRA PUSPITA RATRI', 'gender' => 'F'],
            ['nis' => '13135', 'nisn' => '0085200259', 'name' => 'DECHA ANNABEL MAULIDA', 'gender' => 'F'],
            ['nis' => '13136', 'nisn' => '0085761123', 'name' => 'DELMORA EXEL MAHESWARA', 'gender' => 'M'],
            ['nis' => '13144', 'nisn' => '0076352960', 'name' => 'DEWI AGUSTIN', 'gender' => 'F'],
            ['nis' => '13155', 'nisn' => '0143210326', 'name' => 'DISA MAHALILAN ABDI', 'gender' => 'F'],
            ['nis' => '13165', 'nisn' => '0078372934', 'name' => 'ERINA AULIA HERVANDA', 'gender' => 'F'],
            ['nis' => '13180', 'nisn' => '0085609752', 'name' => 'FAIZA NADIRA HISANSAH', 'gender' => 'F'],
            ['nis' => '13181', 'nisn' => '0085617923', 'name' => 'FARAH AZ ZAHRA', 'gender' => 'F'],
            ['nis' => '13187', 'nisn' => '0077615887', 'name' => 'FATIH IFTIKHARUS SADAT', 'gender' => 'M'],
            ['nis' => '13192', 'nisn' => '0086756162', 'name' => 'FIONA PUTRI FELICIA', 'gender' => 'F'],
            ['nis' => '13204', 'nisn' => '0077216520', 'name' => 'GOVINDA NITYA DHARMA', 'gender' => 'M'],
            ['nis' => '13209', 'nisn' => '0075906880', 'name' => 'HENDITA SALMA RAMADHANI', 'gender' => 'M'],
            ['nis' => '13235', 'nisn' => '0082868419', 'name' => 'KEZIA JEANNE AHURELIA MARBUN', 'gender' => 'F'],
            ['nis' => '13240', 'nisn' => '0085853349', 'name' => 'KIRANI FADHILAH AZZAHRA', 'gender' => 'F'],
            ['nis' => '13246', 'nisn' => '0082237277', 'name' => 'LINTANG ATHA SALWA MUFTI', 'gender' => 'F'],
            ['nis' => '13254', 'nisn' => '0084241970', 'name' => 'MARITZA MELATI PUTRI', 'gender' => 'F'],
            ['nis' => '13321', 'nisn' => '0078181108', 'name' => 'NASYWA AL-KHALIFI SUWANDY PUTRI', 'gender' => 'F'],
            ['nis' => '13328', 'nisn' => '0084634682', 'name' => 'NAURA ZHALFA DEVIANTI', 'gender' => 'F'],
            ['nis' => '13340', 'nisn' => '0083676038', 'name' => 'NI PUTU AYU NAURA ANANDETA', 'gender' => 'F'],
            ['nis' => '13344', 'nisn' => '0088066936', 'name' => 'ORLEAN ARIANO BHAGASKARA', 'gender' => 'M'],
            ['nis' => '13375', 'nisn' => '0079229692', 'name' => 'RENJIRO JAVIER ADINATA', 'gender' => 'M'],
            ['nis' => '13377', 'nisn' => '0086137460', 'name' => 'REYNARD PUTRA ANTHURISQI', 'gender' => 'M'],
            ['nis' => '13384', 'nisn' => '0088642483', 'name' => 'RIZKA ERSA MAULIDDINA', 'gender' => 'F'],
            ['nis' => '13389', 'nisn' => '0078043289', 'name' => 'RUKMA MAYA ARGYA ELVARETTA', 'gender' => 'F'],
            ['nis' => '13426', 'nisn' => '0081437937', 'name' => 'TRISTAN DANISH EKA PRASETYO', 'gender' => 'M'],
            ['nis' => '13449', 'nisn' => '0084898550', 'name' => 'ZAHRINA ZATIL AQMAR', 'gender' => 'F'],
            ['nis' => '13450', 'nisn' => '0079083967', 'name' => 'ZAHROTUS DEVINA PUTRI', 'gender' => 'F'],
        ];

        // Data siswa Kelas XI IPS
        $studentsXIIPS = [
            ['nis' => '13028', 'nisn' => '0079232213', 'name' => 'ADELISA MUNA SATRI ANHAWI', 'gender' => 'F'],
            ['nis' => '13050', 'nisn' => '0079540729', 'name' => 'ALICIA OCTAVIA RAMADHANI', 'gender' => 'F'],
            ['nis' => '13052', 'nisn' => '3077239944', 'name' => 'ALIFFATUL NAIFAH RAHMA', 'gender' => 'F'],
            ['nis' => '13057', 'nisn' => '0078606906', 'name' => 'ALLEEA KIRANI ZUBED', 'gender' => 'F'],
            ['nis' => '13074', 'nisn' => '0087907266', 'name' => 'ANGGER IDAYU SEKARINGTYAS', 'gender' => 'F'],
            ['nis' => '13077', 'nisn' => '0082687961', 'name' => 'ANISSA ENDAH EVIANA', 'gender' => 'F'],
            ['nis' => '13080', 'nisn' => '0086028270', 'name' => 'ANNISA APRILLIA SUSANTO', 'gender' => 'F'],
            ['nis' => '13104', 'nisn' => '0082319285', 'name' => 'AUREL INDAH DWI SAPUTRI', 'gender' => 'F'],
            ['nis' => '13125', 'nisn' => '0072489642', 'name' => 'CHRISTIAN REYNOLD ALINSKIE', 'gender' => 'M'],
            ['nis' => '13142', 'nisn' => '0083625446', 'name' => 'DEVIANA SALSABILA', 'gender' => 'F'],
            ['nis' => '13151', 'nisn' => '0078422213', 'name' => 'DINDA PUTRI DONALIDYA', 'gender' => 'F'],
            ['nis' => '13160', 'nisn' => '0088145721', 'name' => 'ELLINE PUTRI SYAM', 'gender' => 'F'],
            ['nis' => '13197', 'nisn' => '0082431500', 'name' => 'GALIH ADI WANGSA PRAWIRA PUTRA', 'gender' => 'M'],
            ['nis' => '13198', 'nisn' => '0074297769', 'name' => 'GELSI TANISHA PRADANI', 'gender' => 'F'],
            ['nis' => '13202', 'nisn' => '0089766964', 'name' => 'GIRLI JENI PUTRI SUPRIYO', 'gender' => 'F'],
            ['nis' => '13203', 'nisn' => '0077451960', 'name' => 'GITARA AHMAD SATRIANI', 'gender' => 'M'],
            ['nis' => '13208', 'nisn' => '0087824356', 'name' => 'HANUM KHOIRUN NISA RAHMAWAN', 'gender' => 'F'],
            ['nis' => '13220', 'nisn' => '0076928477', 'name' => 'JEPHANY REAPHAELACENOS MANURUNG', 'gender' => 'F'],
            ['nis' => '13223', 'nisn' => '0081346042', 'name' => 'JOSEPHINE MERRY TAN', 'gender' => 'F'],
            ['nis' => '13234', 'nisn' => '0072041980', 'name' => 'KEYSHA AMALIA FIRLYANDA', 'gender' => 'F'],
            ['nis' => '13239', 'nisn' => '0085878465', 'name' => 'KINANISYA MAHARANI', 'gender' => 'F'],
            ['nis' => '13250', 'nisn' => '0078290373', 'name' => 'MAISUNA SHIFA NUHA', 'gender' => 'F'],
            ['nis' => '13272', 'nisn' => '0081027924', 'name' => 'MOHAMMAD RIZKY RENDI ANUGRAH', 'gender' => 'M'],
            ['nis' => '13285', 'nisn' => '0074573572', 'name' => 'MUHAMMAD ARSY WAHYU WIBIKSANA', 'gender' => 'M'],
            ['nis' => '13317', 'nisn' => '0081456664', 'name' => 'NAJWA HIDAYATUR ROCHMAH', 'gender' => 'F'],
            ['nis' => '13332', 'nisn' => '0071413527', 'name' => 'NAYLA RAHMANIYAH CIPTADI', 'gender' => 'F'],
            ['nis' => '13333', 'nisn' => '0077505678', 'name' => 'NAYLAH AURA KURNIAWAN', 'gender' => 'F'],
            ['nis' => '13335', 'nisn' => '0082654274', 'name' => 'NAZWA MALIKA ALEA SETYAWAN', 'gender' => 'F'],
            ['nis' => '13338', 'nisn' => '0078457997', 'name' => 'NEYREDIS QORIHONEY HERBINA', 'gender' => 'F'],
            ['nis' => '13407', 'nisn' => '0073511336', 'name' => 'SHINTA MAHARANI PUTRI', 'gender' => 'F'],
            ['nis' => '13409', 'nisn' => '0086629032', 'name' => 'SISIKIRANA TIARA SUSANTO', 'gender' => 'F'],
            ['nis' => '13410', 'nisn' => '0071953606', 'name' => 'SITI NAURA KAMILA AZALIA', 'gender' => 'F'],
            ['nis' => '13420', 'nisn' => '0075503623', 'name' => 'TARISHA LIVANA RAMAFINDA', 'gender' => 'F'],
            ['nis' => '13428', 'nisn' => '0086513471', 'name' => 'UFQI NUHA SHOFIYAH', 'gender' => 'F'],
            ['nis' => '13430', 'nisn' => '0083007954', 'name' => 'VANNESSA AUDREY SANDRIA CHLOIE', 'gender' => 'F'],
            ['nis' => '13441', 'nisn' => '0071544667', 'name' => 'YANISA ARRAYAN ADE RIYADINI', 'gender' => 'F'],
            ['nis' => '13447', 'nisn' => '0076310840', 'name' => 'ZAHIR YAHYA HAMID', 'gender' => 'M'],
            ['nis' => '13448', 'nisn' => '0076501609', 'name' => 'ZAHIRA AURYNAYNA XAVIER', 'gender' => 'F'],
        ];

        // Data siswa Kelas XII IPA
        $studentsXIIIPA = [
            ['nis' => '12620', 'nisn' => '0067366782', 'name' => 'ADELLA AYU SAVIRA', 'gender' => 'F'],
            ['nis' => '12622', 'nisn' => '0079992470', 'name' => 'AGATA TRIANA FEBRIANI', 'gender' => 'F'],
            ['nis' => '12628', 'nisn' => '0061907755', 'name' => 'AIDIL FALAH ZAIDAN AQMAL', 'gender' => 'M'],
            ['nis' => '13006', 'nisn' => '0062906173', 'name' => 'AIRIN DEBRINA ZAHRAN', 'gender' => 'F'],
            ['nis' => '12632', 'nisn' => '0066707104', 'name' => 'ALIFA WULANDARI', 'gender' => 'F'],
            ['nis' => '12638', 'nisn' => '0079019260', 'name' => 'ALVIAN GALANG FATWA AKBAR', 'gender' => 'M'],
            ['nis' => '12644', 'nisn' => '0074387503', 'name' => 'AMANTA MUTIARA WAHYU PUTRI', 'gender' => 'F'],
            ['nis' => '12645', 'nisn' => '0076663621', 'name' => 'AMBAR ALIFFITRIANI', 'gender' => 'F'],
            ['nis' => '12655', 'nisn' => '0079656041', 'name' => 'ANDHINI PUTRI RAMADHANI', 'gender' => 'F'],
            ['nis' => '12663', 'nisn' => '0072006547', 'name' => 'ANINDYA DAVINA', 'gender' => 'F'],
            ['nis' => '12687', 'nisn' => '0066603113', 'name' => 'BERDY KARUNIA', 'gender' => 'F'],
            ['nis' => '12698', 'nisn' => '0072533284', 'name' => 'CANTIKA ADIRA KANIA', 'gender' => 'F'],
            ['nis' => '12711', 'nisn' => '0073333030', 'name' => 'DAFFA ADE RAZDITYA', 'gender' => 'M'],
            ['nis' => '12717', 'nisn' => '3078930139', 'name' => 'DENISA AYU SUKMANA PUTRA', 'gender' => 'F'],
            ['nis' => '12756', 'nisn' => '0065477427', 'name' => 'FERIA HAWA RAMADANI', 'gender' => 'F'],
            ['nis' => '12760', 'nisn' => '0063024951', 'name' => 'FILDA PUTRI CAHYA NINGRUM', 'gender' => 'F'],
            ['nis' => '12761', 'nisn' => '0072514437', 'name' => 'FIRANIA NADHIFA', 'gender' => 'F'],
            ['nis' => '12763', 'nisn' => '0072757215', 'name' => 'FLORA RHEA AZZAHRA SHOULL META', 'gender' => 'F'],
            ['nis' => '12792', 'nisn' => '0072238902', 'name' => 'KAYLA PUTRI RAHMADITA', 'gender' => 'F'],
            ['nis' => '13009', 'nisn' => '0072402367', 'name' => 'KEISYA QISMIKA ADZRAA PUTRI WICAKSONO', 'gender' => 'F'],
            ['nis' => '12800', 'nisn' => '0076420572', 'name' => 'KOMANG PRABU SUTHALEKSANA', 'gender' => 'M'],
            ['nis' => '12802', 'nisn' => '0079395788', 'name' => 'LAISHA AYU ATHALIA', 'gender' => 'F'],
            ['nis' => '12810', 'nisn' => '0063013188', 'name' => 'LUQYANA UTARI', 'gender' => 'F'],
            ['nis' => '12833', 'nisn' => '0068685312', 'name' => 'MUCHAMMAD AKBAR PUTRA PRATAMA', 'gender' => 'M'],
            ['nis' => '12835', 'nisn' => '0076630225', 'name' => 'MUHAMMAD ALHADY RIZQ', 'gender' => 'M'],
            ['nis' => '12848', 'nisn' => '0064552099', 'name' => 'MUHAMMAD ILHAM FAUZI', 'gender' => 'M'],
            ['nis' => '12869', 'nisn' => '0067631901', 'name' => 'NADINE PERMATA RUDIYANTO', 'gender' => 'F'],
            ['nis' => '12892', 'nisn' => '0076708149', 'name' => 'NISRINA PUTRI WIJAKSONO', 'gender' => 'F'],
            ['nis' => '12904', 'nisn' => '0015201151', 'name' => 'PRIMA AJI SENTOSA', 'gender' => 'M'],
            ['nis' => '12923', 'nisn' => '0067226556', 'name' => 'RAMEYZA ALYA RAFEYFA NARESWARI', 'gender' => 'F'],
            ['nis' => '12935', 'nisn' => '0076576019', 'name' => 'RIFATUL NAILAH PUTRI', 'gender' => 'F'],
            ['nis' => '12949', 'nisn' => '0069108218', 'name' => 'SALSABILA PUTRI RAHMADANI', 'gender' => 'F'],
            ['nis' => '12971', 'nisn' => '0075541986', 'name' => 'SUSHITA KIRANIA HARDIMAN', 'gender' => 'F'],
            ['nis' => '12983', 'nisn' => '0085046647', 'name' => 'VELLACIA SHAFARA RAHMAN', 'gender' => 'F'],
            ['nis' => '12995', 'nisn' => '0073268219', 'name' => 'ZAHRA AURELIA AGUSTINE', 'gender' => 'F'],
        ];

        // Data siswa Kelas XII IPS
        $studentsXIIIPS = [
            ['nis' => '12630', 'nisn' => '0062419694', 'name' => 'ALEXANDER IMMANUEL JASON SANTOSO', 'gender' => 'M'],
            ['nis' => '12679', 'nisn' => '0068715174', 'name' => 'AULIA RENATA', 'gender' => 'F'],
            ['nis' => '12682', 'nisn' => '0072569274', 'name' => 'BAALQIS SALTSABILLAH', 'gender' => 'F'],
            ['nis' => '12706', 'nisn' => '0064183991', 'name' => 'CHRISTI SUKMANING TYAS', 'gender' => 'F'],
            ['nis' => '12709', 'nisn' => '0074387884', 'name' => 'CLARA VALEN ADELYA PUTRI', 'gender' => 'F'],
            ['nis' => '12747', 'nisn' => '0061195359', 'name' => 'FADHIL MAULANA IHSAN', 'gender' => 'M'],
            ['nis' => '12750', 'nisn' => '0069466513', 'name' => 'FARAH GHAIDA TSURAYA', 'gender' => 'F'],
            ['nis' => '12751', 'nisn' => '0066280382', 'name' => 'FAREL DWI KURNIA PUTRA', 'gender' => 'M'],
            ['nis' => '12754', 'nisn' => '0079659464', 'name' => 'FAZLUR KAULAN SADIDA', 'gender' => 'M'],
            ['nis' => '12772', 'nisn' => '0069953051', 'name' => 'HANAN ABIYU MAJID', 'gender' => 'M'],
            ['nis' => '12775', 'nisn' => '0083026867', 'name' => 'HERVINA INEZTIRZA', 'gender' => 'F'],
            ['nis' => '12778', 'nisn' => '0063731093', 'name' => 'ICHA AULIA MARNANTA', 'gender' => 'F'],
            ['nis' => '12781', 'nisn' => '0064225691', 'name' => 'INDRA SEPTIAN RAMADHAN', 'gender' => 'M'],
            ['nis' => '12794', 'nisn' => '0075515375', 'name' => 'KEISYA AZ ZAHRA PRASETYA', 'gender' => 'F'],
            ['nis' => '12797', 'nisn' => '0074053766', 'name' => 'KIKO ANDY TAZEKA', 'gender' => 'M'],
            ['nis' => '12798', 'nisn' => '0073170619', 'name' => 'KIRANA MAHESHWARI', 'gender' => 'F'],
            ['nis' => '12803', 'nisn' => '0071275408', 'name' => 'LENIRA PUTRI FEBRIARNI', 'gender' => 'F'],
            ['nis' => '12818', 'nisn' => '0075070481', 'name' => 'MARSHA RANI SAFFANAH', 'gender' => 'F'],
            ['nis' => '12829', 'nisn' => '0068961176', 'name' => 'MOH. ROHAN ADE PURWANTO', 'gender' => 'M'],
            ['nis' => '12860', 'nisn' => '0069241859', 'name' => 'MUHAMMAD RENDY ANDIKA', 'gender' => 'M'],
            ['nis' => '12861', 'nisn' => '0077768679', 'name' => 'MUHAMMAD RIO DWI SAMUDERA', 'gender' => 'M'],
            ['nis' => '12866', 'nisn' => '0068891491', 'name' => 'NABILA SALSABILA', 'gender' => 'F'],
            ['nis' => '12870', 'nisn' => '0079902717', 'name' => 'NADINE SHAFA ALNAYRA', 'gender' => 'F'],
            ['nis' => '12887', 'nisn' => '0078592294', 'name' => 'NELLA DEVITASARI LUBIS', 'gender' => 'F'],
            ['nis' => '12893', 'nisn' => '0068686432', 'name' => 'NIZAR IRAWAN', 'gender' => 'M'],
            ['nis' => '12896', 'nisn' => '0062597317', 'name' => 'OCTAVIA AURA PUSPA RACHMADANI', 'gender' => 'F'],
            ['nis' => '12905', 'nisn' => '0073611952', 'name' => 'PRINCESSA LAURACEAE PHOEBE HADIANA', 'gender' => 'F'],
            ['nis' => '12906', 'nisn' => '0062630575', 'name' => 'PULUNG PANGARIBOWO', 'gender' => 'M'],
            ['nis' => '12908', 'nisn' => '0066558365', 'name' => 'PUTU AYU MIRAHANDANI', 'gender' => 'F'],
            ['nis' => '12919', 'nisn' => '0069529791', 'name' => 'RAIHANDIO EDRA FAIRUZAIN', 'gender' => 'M'],
            ['nis' => '12926', 'nisn' => '0077721050', 'name' => 'RASSYA WANGSA DIRJA', 'gender' => 'M'],
            ['nis' => '13461', 'nisn' => '0061046572', 'name' => 'RENO DWI PRAYOGO', 'gender' => 'M'],
            ['nis' => '13011', 'nisn' => '0071674917', 'name' => 'REYCILLYA TRISTANTO SANTOSO', 'gender' => 'F'],
            ['nis' => '12948', 'nisn' => '0075233257', 'name' => 'SAFA ZHAFIRA RAHMANI', 'gender' => 'F'],
            ['nis' => '12975', 'nisn' => '0077163661', 'name' => 'TASYA FEBRIANTY PUTRI', 'gender' => 'F'],
            ['nis' => '12993', 'nisn' => '0075099384', 'name' => 'YOHAN SANJAYA', 'gender' => 'M'],
        ];

        $this->saveStudents($studentsXIPA, $classXIPA->id, 'X IPA');
        $this->saveStudents($studentsXIPS, $classXIPS->id, 'X IPS');
        $this->saveStudents($studentsXIIPA, $classXIIPA->id, 'XI IPA');
        $this->saveStudents($studentsXIIPS, $classXIIPS->id, 'XI IPS');
        $this->saveStudents($studentsXIIIPA, $classXIIIPA->id, 'XII IPA');
        $this->saveStudents($studentsXIIIPS, $classXIIIPS->id, 'XII IPS');

        $this->command->info('Semua data siswa berhasil dimasukkan!');
    }

    /**
     * Simpan data siswa ke database
     *
     * @param array $students
     * @param int $classId
     * @param string $className
     * @return void
     */
    private function saveStudents(array $students, int $classId, string $className): void
    {
        $faker = Faker::create('id_ID');
        $this->command->info("Memasukkan " . count($students) . " siswa ke kelas " . $className);

        // Determine age range based on class level
        $ageRange = $this->getAgeRangeForClass($className);

        foreach ($students as $student) {
            // Format email dari nama siswa
            $nameParts = explode(' ', $student['name']);
            $firstName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nameParts[0]));
            $email = $firstName . $faker->numberBetween(100, 999) . '@gmail.com';

            // Cek apakah NIS sudah ada di database
            $existingNis = DB::table('students')->where('nis', $student['nis'])->first();

            if ($existingNis) {
                $this->command->warn("NIS {$student['nis']} untuk {$student['name']} sudah ada, melewati.");
                continue;
            }

            // Insert data ke tabel users terlebih dahulu
            $userId = DB::table('users')->insertGetId([
                'name' => $student['name'],
                'email' => $email,
                'phone_number' => '08' . $faker->numerify('##########'),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'role' => 'student',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Kemudian insert data ke tabel students
            DB::table('students')->insert([
                'user_id' => $userId,
                'class_id' => $classId,
                'nis' => $student['nis'],
                'nisn' => $student['nisn'],
                'place_of_birth' => $faker->city,
                'date_of_birth' => $faker->dateTimeBetween($ageRange['min'], $ageRange['max'])->format('Y-m-d'),
                'gender' => $student['gender'],
                'address' => 'Jl. ' . $faker->streetName . ' No. ' . $faker->buildingNumber,
                'father_name' => $faker->name('male'),
                'mother_name' => $faker->name('female'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $this->command->info("Siswa {$student['name']} dengan NIS {$student['nis']} berhasil dimasukkan");
        }
    }

    /**
     * Get the age range for a specific class level
     *
     * @param string $className
     * @return array
     */
    private function getAgeRangeForClass(string $className): array
    {
        // Extract the class level from the class name
        if (strpos($className, 'X') !== false) {
            // Kelas 10 (X): 15-16 tahun
            return [
                'min' => '-16 years',
                'max' => '-15 years'
            ];
        } elseif (strpos($className, 'XI') !== false) {
            // Kelas 11 (XI): 16-17 tahun
            return [
                'min' => '-17 years',
                'max' => '-16 years'
            ];
        } elseif (strpos($className, 'XII') !== false) {
            // Kelas 12 (XII): 17-18 tahun (maksimal 19 tahun)
            return [
                'min' => '-18 years',
                'max' => '-17 years'
            ];
        } else {
            // Default range if class level is not recognized
            return [
                'min' => '-19 years', // Maximum age
                'max' => '-15 years'  // Minimum age
            ];
        }
    }
}
