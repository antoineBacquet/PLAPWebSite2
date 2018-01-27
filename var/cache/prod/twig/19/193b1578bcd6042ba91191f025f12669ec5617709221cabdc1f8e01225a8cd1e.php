<?php

/* admin/members.html.twig */
class __TwigTemplate_eea4b4c71e54fdaeb895a6e63de1b3e2e5acae4310cb08c8e581d7d9261ecec1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 3
        $this->parent = $this->loadTemplate("template/base.html.twig", "admin/members.html.twig", 3);
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
        $__internal_0549d2378b462d7b56f86e929847567be268228f54f6475da4cefcb806677cd8 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_0549d2378b462d7b56f86e929847567be268228f54f6475da4cefcb806677cd8->enter($__internal_0549d2378b462d7b56f86e929847567be268228f54f6475da4cefcb806677cd8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "admin/members.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0549d2378b462d7b56f86e929847567be268228f54f6475da4cefcb806677cd8->leave($__internal_0549d2378b462d7b56f86e929847567be268228f54f6475da4cefcb806677cd8_prof);

    }

    // line 6
    public function block_body($context, array $blocks = array())
    {
        $__internal_900ff213a537ce7863526e57797106daf16bc51fa995696b8ef8cf553e3c6e9d = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_900ff213a537ce7863526e57797106daf16bc51fa995696b8ef8cf553e3c6e9d->enter($__internal_900ff213a537ce7863526e57797106daf16bc51fa995696b8ef8cf553e3c6e9d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 7
        echo "<div class=\"jumbotron main-w\">
    <div class=\"table-responsive\">
        <table class=\"table table-striped\">
            <thead>
                <tr>
                    <td> Nom </td>
                    <td> Groupe </td>
                    <td> Discord lié? </td>
                    <td> Corporation </td>
                </tr>
            </thead>

            <tbody>
                ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["members"]) || array_key_exists("members", $context) ? $context["members"] : (function () { throw new Twig_Error_Runtime('Variable "members" does not exist.', 20, $this->getSourceContext()); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
            // line 21
            echo "                    <tr>
                        <td><a href=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("member", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), $context["member"], "getId", array(), "method"))), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["member"], "getName", array(), "method"), "html", null, true);
            echo " </a>  </td>

                        <td> TODO </td>

                        <td> ";
            // line 26
            if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["member"], "discordId", array()) == null)) {
                echo " Non ";
            } else {
                echo " Oui ";
            }
            echo " </td>

                        <td>";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["member"], "corp", array()), "getCorporationName", array(), "method"), "html", null, true);
            echo "  </td>

                    </tr>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 32
            echo "                    Pas de membres.
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "            </tbody>
        </table>
    </div>
</div>

";
        
        $__internal_900ff213a537ce7863526e57797106daf16bc51fa995696b8ef8cf553e3c6e9d->leave($__internal_900ff213a537ce7863526e57797106daf16bc51fa995696b8ef8cf553e3c6e9d_prof);

    }

    public function getTemplateName()
    {
        return "admin/members.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 34,  90 => 32,  81 => 28,  72 => 26,  63 => 22,  60 => 21,  55 => 20,  40 => 7,  34 => 6,  11 => 3,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("

{% extends 'template/base.html.twig' %}


{% block body %}
<div class=\"jumbotron main-w\">
    <div class=\"table-responsive\">
        <table class=\"table table-striped\">
            <thead>
                <tr>
                    <td> Nom </td>
                    <td> Groupe </td>
                    <td> Discord lié? </td>
                    <td> Corporation </td>
                </tr>
            </thead>

            <tbody>
                {% for member in members %}
                    <tr>
                        <td><a href=\"{{ path('member', { 'id' : member.getId() } ) }}\"> {{ member.getName()}} </a>  </td>

                        <td> TODO </td>

                        <td> {% if member.discordId == null %} Non {% else %} Oui {% endif %} </td>

                        <td>{{ member.corp.getCorporationName()}}  </td>

                    </tr>
                {% else %}
                    Pas de membres.
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>

{% endblock %}", "admin/members.html.twig", "/var/www/plap/app/Resources/views/admin/members.html.twig");
    }
}
