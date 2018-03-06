<?php

class CreatePersoController extends Controleur{
    public function process($request){
        $modele = $this->model;
        $vue = $this->view;
        define('HumainGenreInconnu', 3);
        define('imgHumainFemme', 8);
        define('imgHumainHomme', 9);
        define('humainNguerrier', 11);
        define('humainNAssassin', 10);
        define('humainNMage', 12);
        define('imgHumainHguerrier', 1);
        define('imgHumainHAssassin', 2);
        define('imgHumainHMage', 4);
        define('imgHumainFguerrier', 6);
        define('imgHumainFAssassin', 5);
        define('imgHumainFMage', 7);

    		/* Si on a pas l'id de l'histoire alors index */
    		if(!isset($request['id_histoire'])){
    			$vue->display('index');
    		}

    		/* Les descriptions des classes */
    		$vue->descGuerrier = $modele->getDescClasse('Guerrier');
    		$vue->descAssassin = $modele->getDescClasse('Assassin');
    		$vue->descMage = $modele->getDescClasse('Mage');

    		/* Les images des métiers */
        $vue->imgCourtisan = $modele->getImageMetier('courtisan');
        $vue->imgEclaireur = $modele->getImageMetier('Eclaireur');
        $vue->imgErudit = $modele->getImageMetier('Erudit');
     		$vue->imgMercenaire = $modele->getImageMetier('Mercenaire');
    		$vue->imgRoturier = $modele->getImageMetier('Roturier');
    		$vue->imgSoldat = $modele->getImageMetier('Soldat');

    		/* Les images généres en fonction de la race, de la classe, et du métier */
    		$vue->imgHumainN = $modele->getimgRaceGenre(HumainGenreInconnu);
    		$vue->imgHumainF = $modele->getimgRaceGenre(imgHumainFemme);
    		$vue->imgHumainH = $modele->getimgRaceGenre(imgHumainHomme);

    		$vue->imgHumainNguerrier = $modele->getimgRaceGenre(humainNguerrier);
    		$vue->imgHumainNAssassin = $modele->getimgRaceGenre(humainNAssassin);
    		$vue->imgHumainNMage = $modele->getimgRaceGenre(humainNMage);

    		$vue->imgHumainHguerrier = $modele->getimgRaceGenre(imgHumainHguerrier);
    		$vue->imgHumainHAssassin = $modele->getimgRaceGenre(imgHumainHAssassin);
    		$vue->imgHumainHMage = $modele->getimgRaceGenre(imgHumainHMage);

    		$vue->imgHumainFguerrier = $modele->getimgRaceGenre(imgHumainFguerrier);
    		$vue->imgHumainFAssassin = $modele->getimgRaceGenre(imgHumainFAssassin);
    		$vue->imgHumainFMage = $modele->getimgRaceGenre(imgHumainFMage);

    		/* Les descriptions des métiers */
        $vue->descCourtisan = $modele->getDescMetier('courtisan');
        $vue->descEclaireur = $modele->getDescMetier('Eclaireur');
        $vue->descErudit = $modele->getDescMetier('Erudit');
        $vue->descMercenaire = $modele->getDescMetier('Mercenaire');
        $vue->descRoturier = $modele->getDescMetier('Roturier');
        $vue->descSoldat = $modele->getDescMetier('Soldat');

    		/* Les compétences */
        $vue->descConnaissance = $modele->getDescCompetences('Connaissance');
        $vue->descDebrouillardise = $modele->getDescCompetences('Debrouillardise');
        $vue->descManipulation = $modele->getDescCompetences('Manipulation');
        $vue->descSurvie = $modele->getDescCompetences('Survie');
        $vue->descAcuite = $modele->getDescCompetences('Acuite');
        $vue->descCommandement = $modele->getDescCompetences('Commandement');

    		/* Les statistiques */
        $vue->forceGuerrier = $modele->getForce('Guerrier');
        $vue->ForceMage = $modele->getForce('Mage');
        $vue->forceAssassin = $modele->getForce('Assassin');
        $vue->IntellMage = $modele->getIntell('Mage');
        $vue->IntellAssassin = $modele->getIntell('Assassin');
        $vue->intellGuerrier = $modele->getIntell('Guerrier');
        $vue->DexGuerrier = $modele->getDex('Guerrier');
        $vue->DexAssassin = $modele->getDex('Assassin');
        $vue->DexMage = $modele->getDex('Mage');
        $vue->AppAssassin = $modele->getApp('Assassin');
        $vue->AppMage = $modele->getApp('Mage');
        $vue->AppGuerrier = $modele->getApp('Guerrier');

    		/* l'or selon les métiers */
        $vue->orCourtisan = $modele->getOrMetier('courtisan');
        $vue->orEclaireur = $modele->getOrMetier('Eclaireur');
        $vue->orErudit = $modele->getOrMetier('Erudit');
        $vue->orMercenaire = $modele->getOrMetier('Mercenaire');
        $vue->orRoturier = $modele->getOrMetier('Roturier');
        $vue->orSoldat = $modele->getOrMetier('Soldat');

    		/* Les statistiques selon les metiers  */
        $vue->forceCourtisan = $modele->getInfosMetier('Courtisan','modifForce');
        $vue->intellCourtisan = $modele->getInfosMetier('Courtisan','modifIntell');
        $vue->dexCourtisan = $modele->getInfosMetier('Courtisan','modifDex');
        $vue->apparanceCourtisan = $modele->getInfosMetier('Courtisan','modifApparence');

        $vue->ForceEclaireur = $modele->getInfosMetier('Eclaireur','modifForce');
        $vue->IntellEclaireur = $modele->getInfosMetier('Eclaireur','modifIntell');
        $vue->DexEclaireur = $modele->getInfosMetier('Eclaireur','modifDex');
        $vue->AppEclaireur = $modele->getInfosMetier('Eclaireur','modifApparence');

        $vue->ForceErudit = $modele->getInfosMetier('Erudit','modifForce');
        $vue->IntellErudit = $modele->getInfosMetier('Erudit','modifIntell');
        $vue->DexErudit = $modele->getInfosMetier('Erudit','modifDex');
        $vue->ApparenceErudit = $modele->getInfosMetier('Erudit','modifApparence');

        $vue->ForceMercenaire = $modele->getInfosMetier('Mercenaire','modifForce');
        $vue->IntellMercenaire = $modele->getInfosMetier('Mercenaire','modifIntell');
        $vue->DexMercenaire = $modele->getInfosMetier('Mercenaire','modifDex');
        $vue->ApparenceMercenaire = $modele->getInfosMetier('Mercenaire','modifApparence');

        $vue->ForceRoturier = $modele->getInfosMetier('Roturier','modifForce');
        $vue->IntellRoturier = $modele->getInfosMetier('Roturier','modifIntell');
        $vue->DexRoturier = $modele->getInfosMetier('Roturier','modifDex');
        $vue->AppRoturier = $modele->getInfosMetier('Roturier','modifApparence');

        $vue->ForceSoldat = $modele->getInfosMetier('Soldat','modifForce');
        $vue->IntellSoldat = $modele->getInfosMetier('Soldat','modifIntell');
        $vue->DexSoldat = $modele->getInfosMetier('Soldat','modifDex');
        $vue->AppSoldat = $modele->getInfosMetier('Soldat','modifApparence');

    		$vue->pointsVieHMin = $modele->getPVHumainMin();
    		$vue->pointsVieHMax = $modele->getPVHumainMax();

    		$vue->pointsManaHMin = $modele->getManaHumainMin();
    		$vue->pointsManaHMax = $modele->getManaHumainMax();
    		$vue->display('createPerso');
	}
}
?>
