<?php

namespace App\Enums;

use Illuminate\Database\Eloquent\Collection;

class AutoProvisionMonitorStates extends Collection
{

    //[
    //    [
    //        'process' =>  [
    //                        'linux' => [],
    //                        'windows' => []
    //                     ],
    //        'problems' => [
    //                       'linux' => [],
    //                       'windows' => []
    //                     ],
    //        'final_status'
    //    ]
    //]

    /**
     * @var array
     */
    public array $states = [
        'APPROVED_HOLD',
        'MANUAL_REVIEW',
        'CONFIGURE_OS',
        'CONFIGURE_OS_HOLD',
        'AUTO_PROVISION',
        'MS_AUTO_PROVISION',
        'HARDWARE_HOLD',
        'MANUAL_PROVISION',
        'WOL_SENT',
        'PRE_KICKSTART',
        'MS_WOL_SENT',
        'MS_PRE_ADS',
        'POST_INSTALL_DONE',
        'MS_POST_INSTALL_DONE',
        'MS_NETWORK_CONFIG',
        'RH_NETWORK_CONFIG',
        'READY_FOR_1STBOOT',
        'MS_READY_FOR_1STBOOT',
        '1ST_BOOT',
        'ADS_PXE_BOOT',
        'ADS_PARTITION',
        'ADS_IMAGE_DOWNLOAD',
        'ADS_SYSPREP',
        'ADS_CNTRLR_IP',
        'ADS_BDMP_PORT',
        'ADS_BMCP_PORT',
        'ADS_ADMIN_MAC',
        'ADS_BMSS_BIND',
        'ADS_PUB_KEY',
        'ADS_BMSS_KEY',
        'ADS_IP_ASSIGNED',
        'ADS_OS_BOOT',
        'HTTPD_PATCH',
        'OS_HARDENING',
        'BIND_ADDITIONAL_IPS',
        'HOST_IDS',
        'TRIP_WIRE',
        'ANTI_VIRUS',
        'LIN_SET_IP',
        'UP2DATE',
        'UP2DATE_REGISTER',
        'URCHIN',
        'MY_SQL',
        'CPANEL_INSTALL',
        'FANTASTICO_INSTALL',
        'MS_PLESK_INSTALL',
        'PLESK_INSTALL',
        'PLESK_VERIFY_HOLD',
        'MS_SERVER_CLEANUP',
    ];

    /**
     * AutoProvisionMonitorStates constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $items = $this->states;

        parent::__construct($items);
    }
}
