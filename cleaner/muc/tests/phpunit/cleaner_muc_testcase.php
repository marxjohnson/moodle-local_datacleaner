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
 * @package     cleaner_muc
 * @subpackage  local_cleanurls
 * @author      Daniel Thee Roperto <daniel.roperto@catalyst-au.net>
 * @copyright   2017 Catalyst IT Australia {@link http://www.catalyst-au.net}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use cleaner_muc\cleaner;
use cleaner_muc\dml\muc_config_db;
use cleaner_muc\event\muc_config_deleted;
use cleaner_muc\event\muc_config_event;
use cleaner_muc\event\muc_config_saved;
use cleaner_muc\muc_config;

defined('MOODLE_INTERNAL') || die();

/**
 * Testcase.
 *
 * @package     cleaner_muc
 * @subpackage  local_cleanurls
 * @author      Daniel Thee Roperto <daniel.roperto@catalyst-au.net>
 * @copyright   2017 Catalyst IT Australia {@link http://www.catalyst-au.net}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @SuppressWarnings(public) Allow as many methods as needed.
 */
class local_datacleaner_cleaner_muc_testcase extends advanced_testcase {
    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();

        // Trigger classloaders.
        class_exists(cleaner::class);
        class_exists(muc_config::class);
        class_exists(muc_config_db::class);
        class_exists(muc_config_saved::class);
        class_exists(muc_config_deleted::class);
        class_exists(muc_config_event::class);
    }

    protected static function create_muc_config($wwwroot = 'http://moodle.test',
                                                $configuration = '<?php // Configuration',
                                                $data = []) {
        $defaults = [
            'wwwroot'       => $wwwroot,
            'configuration' => $configuration,
        ];
        $data = array_merge($defaults, $data);

        $config = new muc_config($data);
        muc_config_db::save($config);
        return $config;
    }
}
