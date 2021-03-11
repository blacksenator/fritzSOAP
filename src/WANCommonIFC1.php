<?php

namespace blacksenator\fritzsoap;

/**
 * The class provides functions to read and manipulate
 * data via TR-064 interface on FRITZ!Box router from AVM.
 * No documentation available!
 * @see: https://avm.de/service/schnittstellen/
 *
 * With the instantiation of the class, all available
 * services of the addressed FRITZ!Box are determined.
 * The service parameters and available actions are
 * provided in a compressed form as XML and can be output
 * with getServiceDescription().
 * The matching SOAP client only needs to be called with
 * the name of the services <services name = "..."> and
 * gets the correct location and uri from the XML
 * (see getFritzBoxServices() for details)
 *
 * +++++++++++++++++++++ ATTENTION +++++++++++++++++++++
 * THIS FILE IS AUTOMATIC ASSEMBLED!
 * ALL FUNCTIONS ARE FRAMEWORKS AND HAVE TO BE CORRECTLY
 * CODED, IF THEIR COMMENT WAS NOT OVERWRITTEN!
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++
 *
 * @author Volker Püschel <knuffy@anasco.de>
 * @copyright Volker Püschel 2019 - 2021
 * @license MIT
**/

use blacksenator\fritzsoap\fritzsoap;

class WANCommonIFC1 extends fritzsoap
{
    /**
     * getCommonLinkProperties
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewWANAccessType (string)
     * out: NewLayer1UpstreamMaxBitRate (ui4)
     * out: NewLayer1DownstreamMaxBitRate (ui4)
     * out: NewPhysicalLinkStatus (string)
     *
     * @return array
     */
    public function getCommonLinkProperties()
    {
        $result = $this->client->GetCommonLinkProperties();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

    /**
     * getTotalBytesSent
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewTotalBytesSent (ui4)
     *
     * @return int
     */
    public function getTotalBytesSent()
    {
        $result = $this->client->GetTotalBytesSent();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

    /**
     * getTotalBytesReceived
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewTotalBytesReceived (ui4)
     *
     * @return int
     */
    public function getTotalBytesReceived()
    {
        $result = $this->client->GetTotalBytesReceived();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

    /**
     * getTotalPacketsSent
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewTotalPacketsSent (ui4)
     *
     * @return int
     */
    public function getTotalPacketsSent()
    {
        $result = $this->client->GetTotalPacketsSent();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

    /**
     * getTotalPacketsReceived
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewTotalPacketsReceived (ui4)
     *
     * @return int
     */
    public function getTotalPacketsReceived()
    {
        $result = $this->client->GetTotalPacketsReceived();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

    /**
     * getAddonInfos
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewByteSendRate (ui4)
     * out: NewByteReceiveRate (ui4)
     * out: NewPacketSendRate (ui4)
     * out: NewPacketReceiveRate (ui4)
     * out: NewTotalBytesSent (ui4)
     * out: NewTotalBytesReceived (ui4)
     * out: NewAutoDisconnectTime (ui4)
     * out: NewIdleDisconnectTime (ui4)
     * out: NewDNSServer1 (string)
     * out: NewDNSServer2 (string)
     * out: NewVoipDNSServer1 (string)
     * out: NewVoipDNSServer2 (string)
     * out: NewUpnpControlEnabled (boolean)
     * out: NewRoutedBridgedModeBoth (ui1)
     * out: NewX_AVM_DE_TotalBytesSent64 (string)
     * out: NewX_AVM_DE_TotalBytesReceived64 (string)
     * out: NewX_AVM_DE_WANAccessType (string)
     *
     * @return array
     */
    public function getAddonInfos()
    {
        $result = $this->client->GetAddonInfos();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

    /**
     * x_AVM_DE_GetDsliteStatus
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewX_AVM_DE_DsliteStatus (boolean)
     *
     * @return bool
     */
    public function x_AVM_DE_GetDsliteStatus()
    {
        $result = $this->client->X_AVM_DE_GetDsliteStatus();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

    /**
     * x_AVM_DE_GetIPTVInfos
     *
     * automatically generated; complete coding if necessary!
     *
     * out: NewX_AVM_DE_IPTV_Enabled (boolean)
     * out: NewX_AVM_DE_IPTV_Provider (string)
     * out: NewX_AVM_DE_IPTV_URL (string)
     *
     * @return array
     */
    public function x_AVM_DE_GetIPTVInfos()
    {
        $result = $this->client->X_AVM_DE_GetIPTVInfos();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

        return $result;
    }

}
