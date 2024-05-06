# Lennujaam
<a name="readme-top"></a>
<div>
  <img src="https://eturbonews.com/cdn-cgi/image/width=1212,height=683,fit=crop,quality=80,format=auto,onerror=redirect,metadata=none/wp-content/uploads/2024/01/0-62-810x456.jpg">
</div>
<!-- SISUKORD -->
  <summary>Sisukord</summary>
  <ol>
    <li>
      <a href="#projekti-kohta">Projekti kohta</a>
    </li>
    <li>
      <a href="#kasutamine">Kasutamine</a>
    </li>
    <li>
      <a href="#eesmargid">Eesmärgid</a>
    </li>
    <li>
      <a href="#kontaktid">Kontaktid</a>
    </li>
    <li>
      <a href="#kood-selgitused">Kood selgitused</a>
    </li>
    <li>
      <a href="#ulesanded">Ülesanded</a>
    </li>
  </ol>


<!-- Projekti kohta -->
## Projekti kohta

![pilt](https://github.com/TimurDenisenko/lennujaam/assets/120181244/0c0c61b0-61ca-4d14-ae88-6926a4867617)

Projekt rakendab mõnda <a href="https://timurdenisenko22.thkit.ee/lennujaam/lennukasutaja.php">lennujaama veebisaidi süsteemi </a>. Sellel on kaks lehte:
* Kasutaja leht
* Admin leht.
  
Mitteadministraatorist kasutaja näeb lehte ainult kasutaja jaoks.
Registreerimata kasutaja näeb ainult praeguste lendude andmeid. Kui registreerimata kasutaja otsustab registreeruda, logib ta kohe oma kontole sisse.
Sisselogitud kasutaja saab:
* Eemaldada reisijaid 
* Lisada reisijaid
  
Admin lehel näete kõiki lende, mis on kunagi toimunud.
Administraator saab:
* Alustada uut lendu
* Kustutada vana lennu
* Lõpetada praeguse lennu.
<p align="right">(<a href="#readme-top">tagasi üles</a>)</p>


<!-- Kasutamine -->
## Kasutamine

![Kasutaja leht. Tegevused](https://github.com/TimurDenisenko/lennujaam/assets/120181244/82c1c64b-3686-4297-86f8-8c5b0291b408)
<br>
${\textsf{\color{gray}Kasutaja leht. Tegevused}}$
<br><br>

![Admin leht. Tegevused](https://github.com/TimurDenisenko/lennujaam/assets/120181244/a73eaaa8-71da-430b-b961-39bedcca1bed)
<br>
${\textsf{\color{gray}Admin leht. Tegevused}}$
<br><br>

![Admin leht. Mittetäielikud lennud ja lõpetatud lennud lennu kestusega](https://github.com/TimurDenisenko/lennujaam/assets/120181244/8c75d02b-5147-426f-8e1e-1c49300e3020)
<br>
${\textsf{\color{gray}Admin leht. Mittetäielikud lennud ja lõpetatud lennud lennu kestusega}}$
<br><br>
<p align="right">(<a href="#readme-top">tagasi üles</a>)</p>



<!-- Eesmärgid -->
## Eesmargid

- [x] Andmebaas
- [x] Uute andmete lisamine
- [x] Reisijate lisamine
- [x] Veebileht kõigi lendudega
- [x] Navigeerimismenüü
- [x] Üldine disain
- [x] Registreerimise võimalus
- [ ] Võimalus muuta lennu üksikasju

<p align="right">(<a href="#readme-top">tagasi üles</a>)</p>

<!-- Kontaktid -->
## Kontaktid

Timur Denisenko - <a href="https://timurdenisenko22.thkit.ee/wp/">Õpimapp</a> - timur.denisenko.2109@gmail.com
<br>
Projekti link: [Lennujaam](https://timurdenisenko22.thkit.ee/lennujaam/lennukasutaja.php)

<p align="right">(<a href="#readme-top">tagasi üles</a>)</p>

<!-- Kood selgitused -->
## Kood selgitused
### Kasutaja leht
```
if (isset($_REQUEST["kustutareisitaja"])) {
    $paring_select = $yhendus->prepare("SELECT reisijate_arv FROM lend WHERE id=?");
    $paring_select->bind_param("i", $_REQUEST["kustutareisitaja"]);
    $paring_select->execute();
    $paring_select->bind_result($kohtade_arv_current);
    $paring_select->fetch();
    $paring_select->close();

    if ($kohtade_arv_current != $nool) {
        global $yhendus;
        $kask = $yhendus->prepare("UPDATE lend SET reisijate_arv=reisijate_arv-1 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["kustutareisitaja"]);
        $kask->execute();
    }
}
```
Võtame tabelist reisijate arvu ja kontrollime, kas pärast kustutamist jääb reisijate arv alla nulli, kui ei, siis vähendame reisijate arvu 1 võrra
<br><br>
```
if (isset($_REQUEST["lisareisitaja"])) {
    $paring_select = $yhendus->prepare("SELECT reisijate_arv FROM lend WHERE id=?");
    $paring_select->bind_param("i", $_REQUEST["lisareisitaja"]);
    $paring_select->execute();
    $paring_select->bind_result($kohtade_arv_current);
    $paring_select->fetch();
    $paring_select->close();

    $paring_select = $yhendus->prepare("SELECT kohtade_arv FROM lend WHERE id=?");
    $paring_select->bind_param("i", $_REQUEST["lisareisitaja"]);
    $paring_select->execute();
    $paring_select->bind_result($initial_kohtade_arv);
    $paring_select->fetch();
    $paring_select->close();

    if ($kohtade_arv_current < $initial_kohtade_arv) {
        $kask = $yhendus->prepare("UPDATE lend SET reisijate_arv=reisijate_arv+1 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["lisareisitaja"]);
        $kask->execute();
        $kask->close();
    }
}
```
Tabelist võtame praeguse reisijate arvu ja maksimaalse võimaliku. Järgmisena kontrollime, et praegune reisijate arv ei ületaks maksimaalset võimalikku ja sel juhul suurendame reisijate arvu 1 võrra
<br><br>
<p align="right">(<a href="#readme-top">tagasi üles</a>)</p>

<!-- Ulesanded -->
## Ülesanded

  <ol>
    <li>
      Muutke tabeli päise värvi
    </li>
    <li>
      Muutke tabeli esiletõstmise värvi
    </li>
    <li>
      Muutke päise animatsiooni värvi
    </li>
    <li>
      Muutke tabeli järjekorda
    </li>
    <li>
      Muutke "Lennuk on endiselt õhus" väärtuseks "Lennuk pole ikka veel lendu lõpetanud"
    </li>
  </ol>
