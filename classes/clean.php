<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    local_datacleaner
 * @copyright  2015 Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_datacleaner;

use core\base;

defined('MOODLE_INTERNAL') || die();

abstract class clean {

    private static $tasks = array(); // For storing task start times.

    static public function execute() {

    }

    /*
     * $taskname String A unique name for a cleaning task
     *
     * SHOULD be called at the start with an itemno of 0?
     */
    static protected function update_status($taskname, $itemno, $total) {

        $perc = $itemno * 100 / $total;

        $eta = null;
        $delta = null;
        $now = time();
        $start = null;
        $timeleft = null;
        if (isset(self::$tasks[$taskname])) {

            $start = self::$tasks[$taskname];
            $eta = ($now - $start) * $total / $itemno + $start;
            $timeleft = ($eta - $now) . ' seconds remaining';

        } else {
            self::$tasks[$taskname] = time();
        }

        // If first status record time stamp
        // Do calculation of ETA based on first status.

        printf (" %-20s %4d%% (%d/%d)    $timeleft\n", $taskname, $perc, $itemno, $total);

    }
}
