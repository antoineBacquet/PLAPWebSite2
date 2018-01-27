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
    public static $cliendId = '361951222988668929';

    public static $cliendSecret = 'vC1nVx-h938V4Txzspd56RvvIrUdu8dw';

    public static $redirectURI = "http://localhost/discord/redirect/";

    public static $loginURI = "https://discordapp.com/oauth2/authorize?response_type=code";

    public static $tokenURI = "https://discordapp.com/api/v6/oauth2/token";

    public static $token = 'MzU1NzMwMTcxNDg5MTU3MTMz.DJ7s-g.QEdQwTgGqZMabJ72Q3BYjOim5zQ';

    public static $webhook_url = 'https://discordapp.com/api/webhooks/383371839298207765/MvOKVEt8VpBRxpJOxb9jxW3gP5OKMrjOHSPfkPWbQeIw9eUCuPzX9YmuMsozJ-K1vlKK';
}