<?php

/* admin/member.html.twig */
class __TwigTemplate_720469c6b33701cb8348cf9e26438a590be49a213d6df1eb343fea342bfc7da1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "admin/member.html.twig", 1);
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
        $__internal_a200130cf630fa83ea20d1b5ec8406da2f68d88baeb1254e3d4dadc0a343f37e = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a200130cf630fa83ea20d1b5ec8406da2f68d88baeb1254e3d4dadc0a343f37e->enter($__internal_a200130cf630fa83ea20d1b5ec8406da2f68d88baeb1254e3d4dadc0a343f37e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "admin/member.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a200130cf630fa83ea20d1b5ec8406da2f68d88baeb1254e3d4dadc0a343f37e->leave($__internal_a200130cf630fa83ea20d1b5ec8406da2f68d88baeb1254e3d4dadc0a343f37e_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_bcbf67240a0de94489694b602d1e9a236a2c2bc21038536d83c60ed80eaaab91 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_bcbf67240a0de94489694b602d1e9a236a2c2bc21038536d83c60ed80eaaab91->enter($__internal_bcbf67240a0de94489694b602d1e9a236a2c2bc21038536d83c60ed80eaaab91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "<div class=\"jumbotron main-w\">
    <h2>";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new Twig_Error_Runtime('Variable "member" does not exist.', 6, $this->getSourceContext()); })()), "getName", array(), "method"), "html", null, true);
        echo " </h2> <br>


    ";
        // line 9
        if (twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 9, $this->getSourceContext()); })()), "isAdmin", array())) {
            // line 10
            echo "        ";
            echo             $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->renderBlock((isset($context["group_form"]) || array_key_exists("group_form", $context) ? $context["group_form"] : (function () { throw new Twig_Error_Runtime('Variable "group_form" does not exist.', 10, $this->getSourceContext()); })()), 'form_start');
            echo "
        ";
            // line 11
            echo $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->searchAndRenderBlock((isset($context["group_form"]) || array_key_exists("group_form", $context) ? $context["group_form"] : (function () { throw new Twig_Error_Runtime('Variable "group_form" does not exist.', 11, $this->getSourceContext()); })()), 'widget');
            echo "
        ";
            // line 12
            echo             $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->renderBlock((isset($context["group_form"]) || array_key_exists("group_form", $context) ? $context["group_form"] : (function () { throw new Twig_Error_Runtime('Variable "group_form" does not exist.', 12, $this->getSourceContext()); })()), 'form_end');
            echo "

<div class=\"jumbotron bouton\">

        <br>
        ";
            // line 17
            if ((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["member"]) || array_key_exists("member", $context) ? $context["member"] : (function () { throw new Twig_Error_Runtime('Variable "member" does not exist.', 17, $this->getSourceContext()); })()), "discordId", array()) == null)) {
                echo " Pas de liaison avec le discord ";
            } else {
                echo " <button> Mettre a jour les roles sur discord</button> ";
            }
            // line 18
            echo "</div>

        <h2>Liste des APIs</h2>

        ";
            // line 22
            $this->loadTemplate("template/api_list.html.twig", "admin/member.html.twig", 22)->display($context);
            // line 23
            echo "
    ";
        }
        // line 25
        echo "
    <h3>Liste de ses commandes</h3> <br>
    ";
        // line 27
        $this->loadTemplate("template/command_list.html.twig", "admin/member.html.twig", 27)->display($context);
        // line 28
        echo "</div>
";
        
        $__internal_bcbf67240a0de94489694b602d1e9a236a2c2bc21038536d83c60ed80eaaab91->leave($__internal_bcbf67240a0de94489694b602d1e9a236a2c2bc21038536d83c60ed80eaaab91_prof);

    }

    public function getTemplateName()
    {
        return "admin/member.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 28,  90 => 27,  86 => 25,  82 => 23,  80 => 22,  74 => 18,  68 => 17,  60 => 12,  56 => 11,  51 => 10,  49 => 9,  43 => 6,  40 => 5,  34 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}
<div class=\"jumbotron main-w\">
    <h2>{{ member.getName()  }} </h2> <br>


    {% if user.isAdmin %}
        {{ form_start(group_form) }}
        {{ form_widget(group_form) }}
        {{ form_end(group_form) }}

<div class=\"jumbotron bouton\">

        <br>
        {% if member.discordId == null %} Pas de liaison avec le discord {% else %} <button> Mettre a jour les roles sur discord</button> {% endif %}
</div>

        <h2>Liste des APIs</h2>

        {% include('template/api_list.html.twig') %}

    {% endif %}

    <h3>Liste de ses commandes</h3> <br>
    {% include('template/command_list.html.twig') %}
</div>
{% endblock %}", "admin/member.html.twig", "/var/www/plap/app/Resources/views/admin/member.html.twig");
    }
}
