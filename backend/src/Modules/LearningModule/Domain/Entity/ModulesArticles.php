<?php


namespace App\Modules\LearningModule\Domain\Entity;


use App\Modules\Article\Domain\Entity\Article;
use App\Modules\LearningModule\Domain\Entity\Module;

class ModulesArticles
{
    /** @var Module */
    private $module;
    
    /** @var Article */
    private $article;
    
    /**
     * @return Module
     */
    public function getModule(): Module
    {
        return $this->module;
    }
    
    /**
     * @param Module $module
     *
     * @return ModulesArticles
     */
    public function setModule(Module $module): ModulesArticles
    {
        $this->module = $module;
        return $this;
    }
    
    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }
    
    /**
     * @param Article $article
     *
     * @return ModulesArticles
     */
    public function setArticle(Article $article): ModulesArticles
    {
        $this->article = $article;
        return $this;
    }
}