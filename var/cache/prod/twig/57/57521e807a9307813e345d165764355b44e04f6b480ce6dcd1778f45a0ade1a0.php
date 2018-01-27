<?php

/* template/command_list.html.twig */
class __TwigTemplate_241806cddf1fdd4168d070ffcfab50c0e482b89abc48b2ee06d334c83ce60cba extends Twig_Template
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
        $__internal_45880373988966b39e5d791c0672b9c1317028c540295f12e55d3bf65014b71d = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_45880373988966b39e5d791c0672b9c1317028c540295f12e55d3bf65014b71d->enter($__internal_45880373988966b39e5d791c0672b9c1317028c540295f12e55d3bf65014b71d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "template/command_list.html.twig"));

        // line 1
        echo "<div class=\"table-responsive\">
    <table class=\"table table-striped\">
        <thead>
        <tr> <th> N° </th ><th> Date </th> <th> Importante? </th> <th> Issuer </th> <th> Prix estimé </th> <th> Contractor </th>  <th> State </th> <th> Info </th> <th> Evepraisal </th><th> Action </th> </tr>
        </thead>
        <tbody>
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["commands"]) || array_key_exists("commands", $context) ? $context["commands"] : (function () { throw new Twig_Error_Runtime('Variable "commands" does not exist.', 7, $this->getSourceContext()); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["command"]) {
            // line 8
            echo "
            ";
            // line 9
            if (((( !twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "important", array()) || twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 9, $this->getSourceContext()); })()), "isAdmin", array())) || twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 9, $this->getSourceContext()); })()), "isProdResp", array())) || ((isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 9, $this->getSourceContext()); })()) == twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "issuer", array())))) {
                // line 10
                echo "
                <tr>
                    <td> ";
                // line 12
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "id", array()), "html", null, true);
                echo " </td>
                    <td> ";
                // line 13
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "date", array()), "d/m/Y"), "html", null, true);
                echo " </td>
                    <td> ";
                // line 14
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "important", array())) {
                    echo " Oui ";
                } else {
                    echo " Non ";
                }
                echo " </td>
                    <td> <a href=\"";
                // line 15
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("member", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "issuer", array()), "id", array()))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "issuer", array()), "name", array()), "html", null, true);
                echo " </a> </td>
                    <td> ";
                // line 16
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "estimatedPrice", array()), 0, ".", ","), "html", null, true);
                echo " </td>
                    <td> ";
                // line 17
                if ((null === twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "contractor", array()))) {
                    echo " - ";
                } else {
                    echo " <a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("member", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "contractor", array()), "id", array()))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "contractor", array()), "name", array()), "html", null, true);
                    echo " </a> ";
                }
                echo "</td>
                    <td> ";
                // line 18
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "state", array()), "html", null, true);
                echo " </td>
                    <td> <a href=\"";
                // line 19
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("commandinfo", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "getId", array(), "method"))), "html", null, true);
                echo "\"> view info </a> </td>
                    <td> <a href=\"";
                // line 20
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "evepraisal", array()), "html", null, true);
                echo "\"> Lien Evepraisal </a> </td>

                    <td>
                        ";
                // line 23
                if (((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 23, $this->getSourceContext()); })()), "isAdmin", array()) || ((isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 23, $this->getSourceContext()); })()) == twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "issuer", array()))) && (twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "state", array()) != "accepted"))) {
                    // line 24
                    echo "                        <a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("removecommand", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), $context["command"], "id", array()))), "html", null, true);
                    echo "\"> Supprimer la commande </a> </td>
                    ";
                } elseif ((twig_get_attribute($this->env, $this->getSourceContext(),                 // line 25
$context["command"], "state", array()) == "accepted")) {
                    // line 26
                    echo "                        Commande fini
                    ";
                } else {
                    // line 28
                    echo "                        -
                    ";
                }
                // line 30
                echo "
                </tr>


            ";
            }
            // line 35
            echo "


        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['command'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "
        </tbody>
    </table>
</div>";
        
        $__internal_45880373988966b39e5d791c0672b9c1317028c540295f12e55d3bf65014b71d->leave($__internal_45880373988966b39e5d791c0672b9c1317028c540295f12e55d3bf65014b71d_prof);

    }

    public function getTemplateName()
    {
        return "template/command_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 39,  119 => 35,  112 => 30,  108 => 28,  104 => 26,  102 => 25,  97 => 24,  95 => 23,  89 => 20,  85 => 19,  81 => 18,  69 => 17,  65 => 16,  59 => 15,  51 => 14,  47 => 13,  43 => 12,  39 => 10,  37 => 9,  34 => 8,  30 => 7,  22 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"table-responsive\">
    <table class=\"table table-striped\">
        <thead>
        <tr> <th> N° </th ><th> Date </th> <th> Importante? </th> <th> Issuer </th> <th> Prix estimé </th> <th> Contractor </th>  <th> State </th> <th> Info </th> <th> Evepraisal </th><th> Action </th> </tr>
        </thead>
        <tbody>
        {% for command in commands %}

            {% if not command.important or user.isAdmin or user.isProdResp or user == command.issuer %}

                <tr>
                    <td> {{ command.id }} </td>
                    <td> {{ command.date|date(\"d/m/Y\") }} </td>
                    <td> {% if command.important  %} Oui {% else %} Non {% endif %} </td>
                    <td> <a href=\"{{ path('member', {id : command.issuer.id} ) }}\">{{ command.issuer.name }} </a> </td>
                    <td> {{ command.estimatedPrice|number_format(0, '.', ',') }} </td>
                    <td> {% if command.contractor is null %} - {% else %} <a href=\"{{ path('member', {id : command.contractor.id} ) }}\">{{ command.contractor.name }} </a> {% endif %}</td>
                    <td> {{ command.state }} </td>
                    <td> <a href=\"{{ path('commandinfo', { 'id' : command.getId() } ) }}\"> view info </a> </td>
                    <td> <a href=\"{{command.evepraisal }}\"> Lien Evepraisal </a> </td>

                    <td>
                        {% if (user.isAdmin or user == command.issuer) and command.state != \"accepted\" %}
                        <a href=\"{{ path('removecommand', {'id' : command.id } ) }}\"> Supprimer la commande </a> </td>
                    {% elseif command.state == \"accepted\" %}
                        Commande fini
                    {% else %}
                        -
                    {% endif %}

                </tr>


            {% endif %}



        {% endfor %}

        </tbody>
    </table>
</div>", "template/command_list.html.twig", "/var/www/plap/app/Resources/views/template/command_list.html.twig");
    }
}
