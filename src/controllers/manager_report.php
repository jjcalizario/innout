<?php

error_reporting(E_ERROR | E_PARSE);
session_start();
requireValidSession();


loadTemplateView('manager_report', []);