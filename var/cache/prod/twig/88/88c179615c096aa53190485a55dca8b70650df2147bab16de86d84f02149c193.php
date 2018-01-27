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
        $__internal_5c3ec092b17af593e2f1f54a489d7d66ef63884b7ef4c64c31398824c307b322 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_5c3ec092b17af593e2f1f54a489d7d66ef63884b7ef4c64c31398824c307b322->enter($__internal_5c3ec092b17af593e2f1f54a489d7d66ef63884b7ef4c64c31398824c307b322_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "profile/apis.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5c3ec092b17af593e2f1f54a489d7d66ef63884b7ef4c64c31398824c307b322->leave($__internal_5c3ec092b17af593e2f1f54a489d7d66ef63884b7ef4c64c31398824c307b322_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_e84e595d12803922ad33ec6f1f1c707839ef3e5efab6127787b5d456894c8f4f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e84e595d12803922ad33ec6f1f1c707839ef3e5efab6127787b5d456894c8f4f->enter($__internal_e84e595d12803922ad33ec6f1f1c707839ef3e5efab6127787b5d456894c8f4f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "
    <h1> Mes API's</h1>

    ";
        // line 8
        $this->loadTemplate("template/api_list.html.twig", "profile/apis.html.twig", 8)->display($context);
        // line 9
        echo "
    <a href=\"";
        // line 10
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("addapi");
        echo "\" > Ajouter un compte </a><br>
    <a href=\"https://login.eveonline.com/Account/LogOff\" target=\"_blank\">Logout from eve</a>


";
        
        $__internal_e84e595d12803922ad33ec6f1f1c707839ef3e5efab6127787b5d456894c8f4f->leave($__internal_e84e595d12803922ad33ec6f1f1c707839ef3e5efab6127787b5d456894c8f4f_prof);

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
        return array (  50 => 10,  47 => 9,  45 => 8,  40 => 5,  34 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}

    <h1> Mes API's</h1>

    {% include('template/api_list.html.twig') %}

    <a href=\"{{ path('addapi') }}\" > Ajouter un compte </a><br>
    <a href=\"https://login.eveonline.com/Account/LogOff\" target=\"_blank\">Logout from eve</a>


{% endblock %}", "profile/apis.html.twig", "/var/www/plap/app/Resources/views/profile/apis.html.twig");
    }
}
