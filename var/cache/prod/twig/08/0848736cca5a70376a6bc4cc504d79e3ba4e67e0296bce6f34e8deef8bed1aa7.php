<?php

/* default/index.html.twig */
class __TwigTemplate_3c1ecde8347e449027f74406193d543e2f9482ebb9f3bc3a6c785896ae4a0a20 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "default/index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "template/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b78a903d8ddd1f877a3538e37f892488829abda6642c76032289aff90276c9a3 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_b78a903d8ddd1f877a3538e37f892488829abda6642c76032289aff90276c9a3->enter($__internal_b78a903d8ddd1f877a3538e37f892488829abda6642c76032289aff90276c9a3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b78a903d8ddd1f877a3538e37f892488829abda6642c76032289aff90276c9a3->leave($__internal_b78a903d8ddd1f877a3538e37f892488829abda6642c76032289aff90276c9a3_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_45c67d6b775022a1730237d7cd1e7dea046b913b26194ec9b8e231c9502870c6 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_45c67d6b775022a1730237d7cd1e7dea046b913b26194ec9b8e231c9502870c6->enter($__internal_45c67d6b775022a1730237d7cd1e7dea046b913b26194ec9b8e231c9502870c6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "
<div class=\"jumbotron main-w\">

       <center><h1 class=\"title\">♦ Pain and Pleasur ♦</h1>
<img class=\"logo\"  src=\"/img/logo.png\">
 
<br>
<br>
        <p class=\"lead\">Nous recherchons des joueurs actifs et ambitieux.
\t<br>
\t<br>
\t\t<b><u>Exigences:</u></b>
\t\t<br>
\t\t\t<li>FULL API Key</li>
\t\t\t<li>20 Millions SPs </li>
\t\t\t<li>Experience PvP </li>
            <li>Savoir être autonome</li>
\t\t\t<li>Skills Armor prioritaires</li>
\t\t\t<li>Avoir l'esprit d'&eacute;quipe</li>
\t\t\t<li>l'Anglais de Fleets est exig&eacute;e</li>
\t\t\t<li>CAP ARMOR READY (supers/titans - FAX obligatoire)</li> 
\t\t\t<li>Teamspeak, Discord et un microphone</li>
\t\t\t<li>NBSI, EUTZ et plus, Fleets actives</li>
<br>
On vends du rève, on fait des tarifs de groupes.. I'm Elite !<span style=\"color:red;\">  Notre channel public in Eve : pap </span></p>
<p>
  <hr class=\"my-4\">
<span style=\"color:red;\">Contact in-game :</span></p> Yanamar Dusk, Maitre Kirua, RAVENnn Otsito, Instiink Loutte, Fbrz</p>
        <a class=\"btn btn-lg btn-primary\" href=\"https://docs.google.com/forms/d/e/1FAIpQLScRg6TbWWOcPJMAxcsBDb9CZuS-fYefmPASXvMPm-AR6Pdpcw/viewform\" role=\"button\">Recrutement</a></center>
      </div>
";
        
        $__internal_45c67d6b775022a1730237d7cd1e7dea046b913b26194ec9b8e231c9502870c6->leave($__internal_45c67d6b775022a1730237d7cd1e7dea046b913b26194ec9b8e231c9502870c6_prof);

    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 4,  34 => 3,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}

{% block body %}

<div class=\"jumbotron main-w\">

       <center><h1 class=\"title\">♦ Pain and Pleasur ♦</h1>
<img class=\"logo\"  src=\"/img/logo.png\">
 
<br>
<br>
        <p class=\"lead\">Nous recherchons des joueurs actifs et ambitieux.
\t<br>
\t<br>
\t\t<b><u>Exigences:</u></b>
\t\t<br>
\t\t\t<li>FULL API Key</li>
\t\t\t<li>20 Millions SPs </li>
\t\t\t<li>Experience PvP </li>
            <li>Savoir être autonome</li>
\t\t\t<li>Skills Armor prioritaires</li>
\t\t\t<li>Avoir l'esprit d'&eacute;quipe</li>
\t\t\t<li>l'Anglais de Fleets est exig&eacute;e</li>
\t\t\t<li>CAP ARMOR READY (supers/titans - FAX obligatoire)</li> 
\t\t\t<li>Teamspeak, Discord et un microphone</li>
\t\t\t<li>NBSI, EUTZ et plus, Fleets actives</li>
<br>
On vends du rève, on fait des tarifs de groupes.. I'm Elite !<span style=\"color:red;\">  Notre channel public in Eve : pap </span></p>
<p>
  <hr class=\"my-4\">
<span style=\"color:red;\">Contact in-game :</span></p> Yanamar Dusk, Maitre Kirua, RAVENnn Otsito, Instiink Loutte, Fbrz</p>
        <a class=\"btn btn-lg btn-primary\" href=\"https://docs.google.com/forms/d/e/1FAIpQLScRg6TbWWOcPJMAxcsBDb9CZuS-fYefmPASXvMPm-AR6Pdpcw/viewform\" role=\"button\">Recrutement</a></center>
      </div>
{% endblock %}
", "default/index.html.twig", "/var/www/plap/app/Resources/views/default/index.html.twig");
    }
}
