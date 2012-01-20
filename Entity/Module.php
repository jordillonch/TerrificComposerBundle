<?php

/*
 * This file is part of the Terrific Composer package.
 *
 * (c) Remo Brunschwiler <remo@terrifically.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Terrific\ComposerBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Module Entity.
 */
class Module implements SearchResult
{
    /**
     * @var string $author
     */
    private $author;

    /**
     * @var string $style
     */
    private $style;

    /**
     *
     * @Assert\NotBlank()
     * @var string $name
     */
    protected $name;

    /**
     *
     * @var array skins
     */
    protected $skins = array();

    /**
     *
     * @var array templates
     */
    protected $templates = array();


    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param array $skins
     */
    public function setSkins($skins)
    {
        $this->skins = $skins;
    }

    /**
     * @return array
     */
    public function getSkins()
    {
        return $this->skins;
    }

    /**
     * @param Skin $skin
     */
    public function addSkin($skin) {
        array_push($this->skins, $skin);
    }

    /**
     * @param array $templates
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @param Template $template
     */
    public function addTemplate($template) {
        array_push($this->templates, $template);
    }

    public function getType()
    {
        return "module";
    }
}