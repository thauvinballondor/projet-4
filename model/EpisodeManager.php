<?php


class EpisodeManager extends BddManager
{

/**
*Sert a stocker tous les episodes dans un tableau
*return un tableau d objet array(object)
**/
  public function findAll()
  {
     $bdd = $this->getBdd();
     // Récupération des 10 derniers messages
     $reponse = $bdd->prepare('SELECT id, titre, episode FROM episode ORDER BY ID');

     $reponse->execute();

    // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
     while ($donnees = $reponse->fetch())
     {
      $episode = new Episode();
      $episode->setId($donnees['id']);
      $episode->setTitre($donnees['titre']);
      $episode->setEpisode($donnees['episode']);

      $episodes[] = $episode;
     };


     return $episodes;
  }
  /**
  *Sert a renvoyer un episode par rapport a son id
  *$id = int
  *return l objet episode = objet
  **/
  public function findBy($id)
  {
    $bdd = $this->getBdd();
    $query = "SELECT id, titre, episode FROM episode WHERE id=:id";
    $reponse = $bdd->prepare($query);
    $reponse->bindValue('id', $id);
    $reponse->execute();
    $donnees = $reponse->fetch();
    $episode = new Episode();
    $episode->setId($donnees['id']);
    $episode->setTitre($donnees['titre']);
    $episode->setEpisode($donnees['episode']);
    return $episode;
  }

  public function addEpisode($titre, $episode)
  {
    $bdd = $this->getBdd();

    $req = $bdd->prepare('INSERT INTO episode (titre, episode) VALUES(?, ?)');
    $req->execute(array($titre, $episode));

    return $this;
  }

  public function delEpisode($id)
  {
       $bdd = $this->getBdd();
       $req = $bdd->prepare('DELETE FROM episode WHERE id=:id');
       $req->bindValue('id', $id);
       $req->execute();

  }

}
