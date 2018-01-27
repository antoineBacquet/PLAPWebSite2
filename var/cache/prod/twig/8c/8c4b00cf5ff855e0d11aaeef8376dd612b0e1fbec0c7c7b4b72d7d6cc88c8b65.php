<?php

/* template/api_list.html.twig */
class __TwigTemplate_ddfd1053ed34e8e7c023775754de6e4114b253f94a8bb66ad3719202b4cd685d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_6fb28a2eb8e265108fe1a34171943df5b6b768f9571eb19a46bf5602a2eb6671 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_6fb28a2eb8e265108fe1a34171943df5b6b768f9571eb19a46bf5602a2eb6671->enter($__internal_6fb28a2eb8e265108fe1a34171943df5b6b768f9571eb19a46bf5602a2eb6671_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "template/api_list.html.twig"));

        // line 1
        echo "<div class=\"table-responsive\">
    <table class=\"table table-striped\">
        <tr>
            <td>Portrait</td>
            <td>Nom du perso</td>
            <td>Toujour valable?</td>
            <td>Action</td>
        </tr>


        ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["apis"]) || array_key_exists("apis", $context) ? $context["apis"] : (function () { throw new Twig_Error_Runtime('Variable "apis" does not exist.', 11, $this->getSourceContext()); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["api"]) {
            // line 12
            echo "            <tr>
                <td> <img src=\"";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "portrait", array()), "html", null, true);
            echo "\"> </td>
                <td> <a href=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("myapi", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "id", array()))), "html", null, true);
            echo " \">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "charName", array()), "html", null, true);
            echo " </a> </td>

                <td>  ";
            // line 16
            if (twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "isValid", array())) {
                echo " oui ";
            } else {
                echo " non ";
            }
            echo "  </td>

                <td> <a href=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("removeapi", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), $context["api"], "id", array()))), "html", null, true);
            echo "\"> Supprimer </a> </td>
            </tr>


        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 23
            echo "            Pas d'API
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['api'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "
    </table>
</div>";
        
        $__internal_6fb28a2eb8e265108fe1a34171943df5b6b768f9571eb19a46bf5602a2eb6671->leave($__internal_6fb28a2eb8e265108fe1a34171943df5b6b768f9571eb19a46bf5602a2eb6671_prof);

    }

    public function getTemplateName()
    {
        return "template/api_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 25,  72 => 23,  62 => 18,  53 => 16,  46 => 14,  42 => 13,  39 => 12,  34 => 11,  22 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"table-responsive\">
    <table class=\"table table-striped\">
        <tr>
            <td>Portrait</td>
            <td>Nom du perso</td>
            <td>Toujour valable?</td>
            <td>Action</td>
        </tr>


        {% for api in apis %}
            <tr>
                <td> <img src=\"{{ api.portrait }}\"> </td>
                <td> <a href=\"{{ path('myapi', { 'id' : api.id } ) }} \">{{ api.charName }} </a> </td>

                <td>  {% if api.isValid %} oui {% else %} non {% endif %}  </td>

                <td> <a href=\"{{ path('removeapi', { 'id' : api.id } ) }}\"> Supprimer </a> </td>
            </tr>


        {% else %}
            Pas d'API
        {% endfor %}

    </table>
</div>", "template/api_list.html.twig", "/var/www/plap/app/Resources/views/template/api_list.html.twig");
    }
}
