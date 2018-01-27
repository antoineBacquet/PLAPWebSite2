<?php

/* profile/apis.html.twig */
class __TwigTemplate_603290491882d698eff6c22e34fcd0fcbfcd3bcdbb3687d171022d7c611c5c7f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "profile/apis.html.twig", 1);
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
        $__internal_8aeebaaa76ddf93b89040ffb44746c56ed15d6fb819d8a50c9834d086444208c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_8aeebaaa76ddf93b89040ffb44746c56ed15d6fb819d8a50c9834d086444208c->enter($__internal_8aeebaaa76ddf93b89040ffb44746c56ed15d6fb819d8a50c9834d086444208c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "profile/apis.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_8aeebaaa76ddf93b89040ffb44746c56ed15d6fb819d8a50c9834d086444208c->leave($__internal_8aeebaaa76ddf93b89040ffb44746c56ed15d6fb819d8a50c9834d086444208c_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_d29b998d122849fd686e57df74fee235fa8abc17b35a21e9f313b873cf41b6d3 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d29b998d122849fd686e57df74fee235fa8abc17b35a21e9f313b873cf41b6d3->enter($__internal_d29b998d122849fd686e57df74fee235fa8abc17b35a21e9f313b873cf41b6d3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "
<div class=\"jumbotron main-w\">
    <h2> Mes API's</h2>

    ";
        // line 9
        $this->loadTemplate("template/api_list.html.twig", "profile/apis.html.twig", 9)->display($context);
        // line 10
        echo "
    <a href=\"";
        // line 11
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("addapi");
        echo "\" > Ajouter un compte </a><br>
    <a href=\"https://login.eveonline.com/Account/LogOff\" target=\"_blank\">Logout from eve</a>

</div>
";
        
        $__internal_d29b998d122849fd686e57df74fee235fa8abc17b35a21e9f313b873cf41b6d3->leave($__internal_d29b998d122849fd686e57df74fee235fa8abc17b35a21e9f313b873cf41b6d3_prof);

    }

    public function getTemplateName()
    {
        return "profile/apis.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 11,  48 => 10,  46 => 9,  40 => 5,  34 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}

<div class=\"jumbotron main-w\">
    <h2> Mes API's</h2>

    {% include('template/api_list.html.twig') %}

    <a href=\"{{ path('addapi') }}\" > Ajouter un compte </a><br>
    <a href=\"https://login.eveonline.com/Account/LogOff\" target=\"_blank\">Logout from eve</a>

</div>
{% endblock %}", "profile/apis.html.twig", "/var/www/plap/app/Resources/views/profile/apis.html.twig");
    }
}
