<?php


include 'Article.php';

class ArticleManager{

    private \PDO $_db;

    public function  __construct(\PDO $_db){
        $this->_db = $_db;
    }

    public function setDb (\PDO $db) {
        $this->_db = $db;
    }

    public function addArticle(Article $article, string $username){
        $ADD_ARTICLE = $this->_db->prepare('
            INSERT INTO article_examen 
            SET nom=:nom, prix=:prix, username=:username');
        $ADD_ARTICLE->bindValue(':nom', $article->getTitre());
        $ADD_ARTICLE->bindValue(':prix', $article->getPrix());
        $ADD_ARTICLE->execute(['nom' => $article->titre, 'prix' => $article->prix, 'username' => $username]);
    }

    public function update(string $titre, string $prix, int $id){
        $UPDATE_ARTICLE = $this->_db->prepare('
            UPDATE article_examen 
            SET nom=:nom, prix=:prix WHERE id=:id');
        if(!$UPDATE_ARTICLE->execute(['nom' => $titre, 'prix' => $prix, 'id' => $id])){
            echo "ho";
            var_dump($UPDATE_ARTICLE->errorInfo());
            die;
        }
        else{
            echo "réussi";
        }
    }

    public function getArticles(): array
    {
        $sth =  $this->_db->prepare(
            'SELECT * FROM article_examen'
        );

        $sth->execute();
        return $sth->fetchAll();
    }

    public function getUserArticle(string $email): array{
        $sth =  $this->_db->prepare(
            'SELECT * FROM article_examen WHERE username=:username'
        );
        $sth->execute(['username' => $email]);
        return $sth->fetchAll();
    }

    public function deleteArticle($article_id) {
        $article_id = (int) $article_id;
        $ARTICLE = $this->_db->prepare('DELETE FROM article_examen WHERE id=:id');
        $ARTICLE->bindValue(':id', $article_id);
        $ARTICLE->execute(['id' => $article_id]);
    }
}