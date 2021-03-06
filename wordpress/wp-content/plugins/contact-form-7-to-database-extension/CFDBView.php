<?php
/*
    "Contact Form to Database" Copyright (C) 2011-2012 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This file is part of Contact Form to Database.

    Contact Form to Database is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Contact Form to Database is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database.
    If not, see <http://www.gnu.org/licenses/>.
*/

abstract class CFDBView {

    /**
     * @abstract
     * @param  $plugin CF7DBPlugin
     * @return void
     */
    abstract function display(&$plugin);

    protected function pageHeader(&$plugin) {
        $this->sponsorLink($plugin);
        $this->headerLinks($plugin);
    }

    function getRequestParam($name) {
        $value = isset($_REQUEST[$name]) ? $_REQUEST[$name] : '';
        // Prevent javascript injection
        $value = str_ireplace('<script', '', $value);
        return $value;
    }

    /**
     * @param $plugin CF7DBPlugin
     * @return void
     */
    protected function sponsorLink(&$plugin) {
    }

    /**
     * @param $plugin CF7DBPlugin
     * @return void
     */
    protected function headerLinks(&$plugin) {
        $notDonated = 'true' != $plugin->getOption('Donated', 'false', true);
        ?>
    <table style="width:100%;">
        <tbody>
        <tr>
            <td style="font-size:x-large;">
                <div style="float:left">
                      <h2> List of Contact personals </h2>
                   
                </div>
            </td>
           
        </tr>
        </tbody>
    </table>
    <?php

    }
}
