<?php

(new Symfony\Component\Dotenv\Dotenv())->loadEnv(dirname(__DIR__) . '/.env');
(new Symfony\Component\Dotenv\Dotenv())->loadEnv(dirname(__DIR__) . '/.env.test');