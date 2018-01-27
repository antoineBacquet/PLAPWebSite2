<?php

/* profile/index.html.twig */
class __TwigTemplate_0dc4b3001b5ed6942426b77a360ee1a3d6606a02a15b3c94f0ca3f976e268a9a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "profile/index.html.twig", 1);
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
        $__internal_1f79a539ae0862aef6d8d4bfdb5de27451d914daa62aefb3483ae36c2b5d9572 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_1f79a539ae0862aef6d8d4bfdb5de27451d914daa62aefb3483ae36c2b5d9572->enter($__internal_1f79a539ae0862aef6d8d4bfdb5de27451d914daa62aefb3483ae36c2b5d9572_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "profile/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1f79a539ae0862aef6d8d4bfdb5de27451d914daa62aefb3483ae36c2b5d9572->leave($__internal_1f79a539ae0862aef6d8d4bfdb5de27451d914daa62aefb3483ae36c2b5d9572_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_e31c4de5c7650ed55e7e63b3163566ed1135679e1c84cc9ddfd22ee9fbae484f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e31c4de5c7650ed55e7e63b3163566ed1135679e1c84cc9ddfd22ee9fbae484f->enter($__internal_e31c4de5c7650ed55e7e63b3163566ed1135679e1c84cc9ddfd22ee9fbae484f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "
<div class=\"jumbotron main-w\">
<h3> Mon profil</h3>


    Connecté en tant que : ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 10, $this->getSourceContext()); })()), "name", array()), "html", null, true);
        echo "
    </div>

";
        
        $__internal_e31c4de5c7650ed55e7e63b3163566ed1135679e1c84cc9ddfd22ee9fbae484f->leave($__internal_e31c4de5c7650ed55e7e63b3163566ed1135679e1c84cc9ddfd22ee9fbae484f_prof);

    }

    public function getTemplateName()
    {
        return "profile/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 10,  40 => 5,  34 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}

<div class=\"jumbotron main-w\">
<h3> Mon profil</h3>


    Connecté en tant que : {{ user.name }}
    </div>

{% endblock %}", "profile/index.html.twig", "/var/www/plap/app/Resources/views/profile/index.html.twig");
    }
}
