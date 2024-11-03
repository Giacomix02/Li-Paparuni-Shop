<?php
class TestStyles extends Controller
{

    function index()
    {   
        if (DEBUG) {
        echo render_view("dashboard.pages.icons.font-awesome");
        }
    }
}