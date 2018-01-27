<?php

/* email/emailsmenu.html.twig */
class __TwigTemplate_cc21d7d59b6d34a28c6e144e61ee4e6a2ec6792fdbb5d1b7d2edb504f79be80b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "email/emailsmenu.html.twig", 1);
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
        $__internal_0edd59f4d53c82db6ff5d443237ddedeba336f2d4b310ce0131490afd75ac691 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_0edd59f4d53c82db6ff5d443237ddedeba336f2d4b310ce0131490afd75ac691->enter($__internal_0edd59f4d53c82db6ff5d443237ddedeba336f2d4b310ce0131490afd75ac691_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "email/emailsmenu.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0edd59f4d53c82db6ff5d443237ddedeba336f2d4b310ce0131490afd75ac691->leave($__internal_0edd59f4d53c82db6ff5d443237ddedeba336f2d4b310ce0131490afd75ac691_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_282f08634e3a15bc29c138e54f71bbfd8dc83938657e85488537080783628011 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_282f08634e3a15bc29c138e54f71bbfd8dc83938657e85488537080783628011->enter($__internal_282f08634e3a15bc29c138e54f71bbfd8dc83938657e85488537080783628011_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "
    <h1> Eve-Emails </h1>

    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["apis"]) || array_key_exists("apis", $context) ? $context["apis"] : (function () { throw new Twig_Error_Runtime('Variable "apis" does not exist.', 8, $this->getSourceContext()); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["api"]) {
            // line 9
            echo "        <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("myemails1", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "getId", array(), "method"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "charName", array()), "html", null, true);
            echo "(";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "unread", array()), "html", null, true);
            echo ")</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['api'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "



";
        
        $__internal_282f08634e3a15bc29c138e54f71bbfd8dc83938657e85488537080783628011->leave($__internal_282f08634e3a15bc29c138e54f71bbfd8dc83938657e85488537080783628011_prof);

    }

    public function getTemplateName()
    {
        return "email/emailsmenu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 11,  49 => 9,  45 => 8,  40 => 5,  34 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}

    <h1> Eve-Emails </h1>

    {% for api in apis %}
        <li><a href=\"{{ path('myemails1', { 'id' : api.getId() } ) }}\">{{ api.charName }}({{ api.unread }})</a></li>
    {%  endfor %}




{% endblock %}", "email/emailsmenu.html.twig", "/var/www/plap/app/Resources/views/email/emailsmenu.html.twig");
    }
}
