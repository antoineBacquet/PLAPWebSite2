<?php

/* command/liste.html.twig */
class __TwigTemplate_2627599cab3f0f9105d758ea10607b7f587d14e4feb4064d48695090a956c8a6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "command/liste.html.twig", 1);
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
        $__internal_376362dcd01bd548686a9b71962d5a0565635cc38c31019e323dd8332f47c101 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_376362dcd01bd548686a9b71962d5a0565635cc38c31019e323dd8332f47c101->enter($__internal_376362dcd01bd548686a9b71962d5a0565635cc38c31019e323dd8332f47c101_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "command/liste.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_376362dcd01bd548686a9b71962d5a0565635cc38c31019e323dd8332f47c101->leave($__internal_376362dcd01bd548686a9b71962d5a0565635cc38c31019e323dd8332f47c101_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_6feb9fcda17eb197f13dea5d0269129752c1f7bca4d0eaa112519e6b062eb579 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_6feb9fcda17eb197f13dea5d0269129752c1f7bca4d0eaa112519e6b062eb579->enter($__internal_6feb9fcda17eb197f13dea5d0269129752c1f7bca4d0eaa112519e6b062eb579_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "

<div class=\"jumbotron main-w\">
<h3> Liste des commandes</h3>

    ";
        // line 10
        $this->loadTemplate("template/command_list.html.twig", "command/liste.html.twig", 10)->display($context);
        // line 11
        echo "
</div>
";
        
        $__internal_6feb9fcda17eb197f13dea5d0269129752c1f7bca4d0eaa112519e6b062eb579->leave($__internal_6feb9fcda17eb197f13dea5d0269129752c1f7bca4d0eaa112519e6b062eb579_prof);

    }

    public function getTemplateName()
    {
        return "command/liste.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 11,  47 => 10,  40 => 5,  34 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}


<div class=\"jumbotron main-w\">
<h3> Liste des commandes</h3>

    {% include('template/command_list.html.twig') %}

</div>
{% endblock %}", "command/liste.html.twig", "/var/www/plap/app/Resources/views/command/liste.html.twig");
    }
}
