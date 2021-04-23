<?php


class Article
{
    public string $prix;
    public string $titre;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set' .ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function setPrix(string $prix){
        $this->prix=$prix;
    }

    public function setTitre(string $titre){
        $this->titre=$titre;
    }

    public function getPrix(){
        return $this->prix;
    }

    public function getTitre(){
        return $this->titre;
    }
}