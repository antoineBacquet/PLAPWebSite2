<?php

/* template/menutmp.html.twig */
class __TwigTemplate_7ca24d7817fe5e29e566dcab6ad029d5b4679ab2a311163fd49607be2e1f8818 extends Twig_Template
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
        $__internal_7f528fd8d4416c47fd206c75e7e8212848e7597011c97aa7308211a90ed7b352 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_7f528fd8d4416c47fd206c75e7e8212848e7597011c97aa7308211a90ed7b352->enter($__internal_7f528fd8d4416c47fd206c75e7e8212848e7597011c97aa7308211a90ed7b352_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "template/menutmp.html.twig"));

        // line 1
        echo "
<div id=\"menunavbar\" class=\"collapse navbar-collapse\">


    <ul class=\"nav navbar-nav\">
        <div class=\"navbar-header\">
            <a class=\"navbar-brand\" href=\"http://plapcorp.com\"><img class=\"logo\"  src=\"/img/logo.png\"></a>
        </div>
               
                ";
        // line 10
        if (array_key_exists("user", $context)) {
            // line 11
            echo "            ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 11, $this->getSourceContext()); })()), "isMember", array()) == true)) {
                // line 12
                echo "                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Mon profil <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"";
                // line 15
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("profile");
                echo "\" >Mon profil</a></li>
                        <li><a class=\"dropdown-item\" href=\"";
                // line 16
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("myapis");
                echo "\" >Mes API</a></li>
                    </ul>
                </li>

                <li>
                <a href=\"";
                // line 21
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("emailsmenu");
                echo "\"> Eve-mails </a>
                </li>

            ";
            }
            // line 25
            echo "        ";
        }
        // line 26
        echo "
        ";
        // line 27
        if (array_key_exists("user", $context)) {
            // line 28
            echo "            ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 28, $this->getSourceContext()); })()), "isMember", array()) == true)) {
                // line 29
                echo "                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Commandes Prod. <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"";
                // line 32
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("commandlist");
                echo "\" >Liste des commandes</a></li>
                        <li><a class=\"dropdown-item\" href=\"";
                // line 33
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("commandadd");
                echo "\" >Ajouter une commande</a></li>
                        <li><a class=\"dropdown-item\" href=\"";
                // line 34
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("usercommandlist", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 34, $this->getSourceContext()); })()), "id", array()))), "html", null, true);
                echo "\" >Mes commands</a></li>
                    </ul>
                </li>
            ";
            }
            // line 38
            echo "        ";
        }
        // line 39
        echo "


        ";
        // line 42
        if (array_key_exists("user", $context)) {
            // line 43
            echo "            ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 43, $this->getSourceContext()); })()), "isMember", array()) == true)) {
                // line 44
                echo "                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Services <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"";
                // line 47
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("discordservice");
                echo "\" >Discord</a></li>
                    </ul>
                </li>


            ";
            }
            // line 53
            echo "        ";
        }
        // line 54
        echo "

        ";
        // line 56
        if (array_key_exists("user", $context)) {
            // line 57
            echo "            ";
            if ((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 57, $this->getSourceContext()); })()), "isAdmin", array()) == true)) {
                // line 58
                echo "                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Administration <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"";
                // line 61
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("members");
                echo "\" >Gestion des utilisateurs</a></li>
                    </ul>
                </li>


            ";
            }
            // line 67
            echo "        ";
        }
        // line 68
        echo "

        ";
        // line 70
        if (array_key_exists("user", $context)) {
            // line 71
            echo "            <li><a class=\"nav-link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("logout");
            echo "\" >Se déconnecter</a></li>
        ";
        } else {
            // line 73
            echo "            <li><a class=\"nav-link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("login");
            echo "\" >Se connecter</a></li>
        ";
        }
        // line 75
        echo "    </ul>
</div>
";
        
        $__internal_7f528fd8d4416c47fd206c75e7e8212848e7597011c97aa7308211a90ed7b352->leave($__internal_7f528fd8d4416c47fd206c75e7e8212848e7597011c97aa7308211a90ed7b352_prof);

    }

    public function getTemplateName()
    {
        return "template/menutmp.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  167 => 75,  161 => 73,  155 => 71,  153 => 70,  149 => 68,  146 => 67,  137 => 61,  132 => 58,  129 => 57,  127 => 56,  123 => 54,  120 => 53,  111 => 47,  106 => 44,  103 => 43,  101 => 42,  96 => 39,  93 => 38,  86 => 34,  82 => 33,  78 => 32,  73 => 29,  70 => 28,  68 => 27,  65 => 26,  62 => 25,  55 => 21,  47 => 16,  43 => 15,  38 => 12,  35 => 11,  33 => 10,  22 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("
<div id=\"menunavbar\" class=\"collapse navbar-collapse\">


    <ul class=\"nav navbar-nav\">
        <div class=\"navbar-header\">
            <a class=\"navbar-brand\" href=\"http://plapcorp.com\"><img class=\"logo\"  src=\"/img/logo.png\"></a>
        </div>
               
                {% if user is defined %}
            {% if user.isMember == true %}
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Mon profil <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"{{ path('profile') }}\" >Mon profil</a></li>
                        <li><a class=\"dropdown-item\" href=\"{{ path('myapis') }}\" >Mes API</a></li>
                    </ul>
                </li>

                <li>
                <a href=\"{{ path('emailsmenu') }}\"> Eve-mails </a>
                </li>

            {% endif %}
        {% endif %}

        {% if user is defined %}
            {% if user.isMember == true %}
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Commandes Prod. <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"{{ path('commandlist') }}\" >Liste des commandes</a></li>
                        <li><a class=\"dropdown-item\" href=\"{{ path('commandadd') }}\" >Ajouter une commande</a></li>
                        <li><a class=\"dropdown-item\" href=\"{{ path('usercommandlist', { 'id' : user.id } ) }}\" >Mes commands</a></li>
                    </ul>
                </li>
            {% endif %}
        {% endif %}



        {% if user is defined %}
            {% if user.isMember == true %}
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Services <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"{{ path('discordservice') }}\" >Discord</a></li>
                    </ul>
                </li>


            {% endif %}
        {% endif %}


        {% if user is defined %}
            {% if user.isAdmin == true %}
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"> Administration <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li><a class=\"dropdown-item\" href=\"{{ path('members') }}\" >Gestion des utilisateurs</a></li>
                    </ul>
                </li>


            {% endif %}
        {% endif %}


        {% if user is defined %}
            <li><a class=\"nav-link\" href=\"{{ path('logout') }}\" >Se déconnecter</a></li>
        {% else %}
            <li><a class=\"nav-link\" href=\"{{ path('login') }}\" >Se connecter</a></li>
        {% endif %}
    </ul>
</div>
", "template/menutmp.html.twig", "/var/www/plap/app/Resources/views/template/menutmp.html.twig");
    }
}
