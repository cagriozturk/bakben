<?php

/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_CachedObjectStorage
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    1.8.0, 2014-03-02
 */


/**
 * PHPExcel_CachedObjectStorageFactory
 *
 * @category    PHPExcel
 * @package        PHPExcel_CachedObjectStorage
 * @copyright    Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_CachedObjectStorageFactory
{
    const cache_in_memory               = 'Memory';
    const cache_in_memory_gzip          = 'MemoryGZip';
    const cache_in_memory_serialized    = 'MemorySerialized';
    const cache_igbinary                = 'Igbinary';
    const cache_to_discISAM             = 'DiscISAM';
    const cache_to_apc                  = 'APC';
    const cache_to_memcache             = 'Memcache';
    const cache_to_phpTemp              = 'PHPTemp';
    const cache_to_wincache             = 'Wincache';
    const cache_to_sqlite               = 'SQLite';
    const cache_to_sqlite3              = 'SQLite3';


    /**
     * Name of the method used for cell cacheing
     *
     * @var string
     */
    private static $_cacheStorageMethod = NULL;

    /**
     * Name of the class used for cell cacheing
     *
     * @var string
     */
    private static $_cacheStorageClass = NULL;


    /**
     * List of all possible cache storage methods
     *
     * @var string[]
     */
    private static $_storageMethods = array(
        self::cache_in_memory,
        self::cache_in_memory_gzip,
        self::cache_in_memory_serialized,
        self::cache_igbinary,
        self::cache_to_phpTemp,
        self::cache_to_discISAM,
        self::cache_to_apc,
        self::cache_to_memcache,
        self::cache_to_wincache,
        self::cache_to_sqlite,
        self::cache_to_sqlite3,
    );


    /**
     * Default arguments for each cache storage method
     *
     * @var array of mixed array
     */
    private static $_storageMethodDefaultParameters 