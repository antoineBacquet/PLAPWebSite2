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
        $__internal_1e9fb53805823857e3c176a41b1f85b91e748051ca201f5d0765fb77e1603076 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_1e9fb53805823857e3c176a41b1f85b91e748051ca201f5d0765fb77e1603076->enter($__internal_1e9fb53805823857e3c176a41b1f85b91e748051ca201f5d0765fb77e1603076_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "email/emailsmenu.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1e9fb53805823857e3c176a41b1f85b91e748051ca201f5d0765fb77e1603076->leave($__internal_1e9fb53805823857e3c176a41b1f85b91e748051ca201f5d0765fb77e1603076_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_e6de130d7366cc40f1b979de13666f2f37d6925c949abbd43ffd325bcf077ab6 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e6de130d7366cc40f1b979de13666f2f37d6925c949abbd43ffd325bcf077ab6->enter($__internal_e6de130d7366cc40f1b979de13666f2f37d6925c949abbd43ffd325bcf077ab6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "<div class=\"jumbotron main-w\">
    <h2> Eve-Emails </h2>

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

</div>

";
        
        $__internal_e6de130d7366cc40f1b979de13666f2f37d6925c949abbd43ffd325bcf077ab6->leave($__internal_e6de130d7366cc40f1b979de13666f2f37d6925c949abbd43ffd325bcf077ab6_prof);

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
<div class=\"jumbotron main-w\">
    <h2> Eve-Emails </h2>

    {% for api in apis %}
        <li><a href=\"{{ path('myemails1', { 'id' : api.getId() } ) }}\">{{ api.charName }}({{ api.unread }})</a></li>
    {%  endfor %}


</div>

{% endblock %}", "email/emailsmenu.html.twig", "/var/www/plap/app/Resources/views/email/emailsmenu.html.twig");
    }
}
