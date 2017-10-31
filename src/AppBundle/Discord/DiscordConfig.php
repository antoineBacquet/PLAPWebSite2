<?php

/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 31/10/2017
 * Time: 23:02
 */


namespace AppBundle\Discord;

class DiscordConfig
{
    public static $cliendId = '355730171489157133';

    public static $cliendSecret = 'unTgDpJ5rtlYw60MfxhfvssNwRmlSHCy';

    public static $redirectURI = "http://87.88.123.72/discord/redirect/";

    public static $loginURI = "https://discordapp.com/oauth2/authorize?response_type=code";

    public static $tokenURI = "https://discordapp.com/api/v6/oauth2/token";

    public static $token = 'MzU1NzMwMTcxNDg5MTU3MTMz.DJ7s-g.QEdQwTgGqZMabJ72Q3BYjOim5zQ';
}