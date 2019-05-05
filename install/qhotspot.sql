/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

UPDATE mysql.user SET Password=PASSWORD('{QH_MYSQL_ROOT_PASS}') WHERE User='root';
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
DELETE FROM mysql.user WHERE User='';
DELETE FROM mysql.db WHERE Db='test' OR Db='test\_%';
CREATE DATABASE IF NOT EXISTS {QH_MYSQL_DBNAME};
CREATE USER `{QH_MYSQL_USER_NAME}`@`localhost`;
SET PASSWORD FOR `{QH_MYSQL_USER_NAME}`@`localhost` = PASSWORD('{QH_MYSQL_USER_PASS}');
GRANT ALL ON {QH_MYSQL_DBNAME}.* TO `{QH_MYSQL_USER_NAME}`@`localhost` IDENTIFIED BY '{QH_MYSQL_USER_PASS}';
GRANT ALL ON {QH_MYSQL_DBNAME}.* TO `{QH_MYSQL_USER_NAME}`@`%` IDENTIFIED BY '{QH_MYSQL_USER_PASS}';

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
SET FOREIGN_KEY_CHECKS=0;

USE {QH_MYSQL_DBNAME};

--
-- Veritabanı: `vuydak_actspotweb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `tckimlikgrup` varchar(254) COLLATE utf8_bin NOT NULL,
  `tckmlikonay` varchar(254) COLLATE utf8_bin NOT NULL,
  `tckimlikdurum` varchar(254) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `tckimlikgrup`, `tckmlikonay`, `tckimlikdurum`) VALUES
(1, '', 'evet', 'hayir');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `grupbilgisi`
--

CREATE TABLE `grupbilgisi` (
  `id` int(11) NOT NULL,
  `grupadi` varchar(64) COLLATE utf8_bin NOT NULL,
  `gaciklamasi` varchar(255) COLLATE utf8_bin NOT NULL,
  `indirmehizi` int(64) NOT NULL,
  `yuklemehizi` int(64) NOT NULL,
  `yonlendirme` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicibilgisi`
--

CREATE TABLE `kullanicibilgisi` (
  `id` int(255) NOT NULL,
  `kullaniciadi` varchar(256) NOT NULL,
  `kayitturu` varchar(255) DEFAULT NULL,
  `kdurumu` varchar(255) DEFAULT NULL,
  `adsoyad` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tcno` varchar(64) NOT NULL,
  `tel` varchar(64) NOT NULL,
  `grupadi` varchar(64) NOT NULL,
  `onay` varchar(64) NOT NULL,
  `indirmehizi` int(64) NOT NULL,
  `yuklemehizi` int(64) NOT NULL,
  `dogum` varchar(64) DEFAULT NULL,
  `islemtz` varchar(64) DEFAULT NULL,
  `gtarihi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `adsoyad` text NOT NULL,
  `rutbe` text NOT NULL,
  `sifre` text NOT NULL,
  `kullaniciadi` text NOT NULL,
  `eposta` varchar(255) DEFAULT NULL,
  `epostaimzasi` text DEFAULT NULL,
  `giris_tarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `cikis_tarih` text DEFAULT NULL,
  `ensonhangisayfada` text DEFAULT NULL,
  `sonipadresi` varchar(255) DEFAULT NULL,
  `durum` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adsoyad`, `rutbe`, `sifre`, `kullaniciadi`, `eposta`, `epostaimzasi`, `giris_tarih`, `cikis_tarih`, `ensonhangisayfada`, `sonipadresi`, `durum`) VALUES
(1, 'Yönetici', 'admin', 'actspot', 'admin', NULL, NULL, '2018-10-30 21:00:00', '2018-11-06 19:31:24', 'actspotweb', 'NULL', 'aktif');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `nas`
--

CREATE TABLE `nas` (
  `id` int(10) NOT NULL,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `radacct`
--

CREATE TABLE `radacct` (
  `radacctid` bigint(21) NOT NULL,
  `acctsessionid` varchar(64) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(50) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctupdatetime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctinterval` int(12) DEFAULT NULL,
  `acctsessiontime` int(12) UNSIGNED DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(50) DEFAULT NULL,
  `connectinfo_stop` varchar(50) DEFAULT NULL,
  `acctinputoctets` bigint(20) DEFAULT NULL,
  `acctoutputoctets` bigint(20) DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `framedipv6address` varchar(44) NOT NULL DEFAULT '',
  `framedipv6prefix` varchar(44) NOT NULL DEFAULT '',
  `framedinterfaceid` varchar(44) NOT NULL DEFAULT '',
  `delegatedipv6prefix` varchar(44) NOT NULL DEFAULT '',
  `acctstartdelay` int(12) DEFAULT NULL,
  `acctstopdelay` int(12) DEFAULT NULL,
  `xascendsessionsvrkey` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `radcheck`
--

CREATE TABLE `radcheck` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  `onay` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `radgroupcheck`
--

CREATE TABLE `radgroupcheck` (
  `id` int(11) UNSIGNED NOT NULL,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `radgroupreply`
--

CREATE TABLE `radgroupreply` (
  `id` int(11) UNSIGNED NOT NULL,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `radpostauth`
--

CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `radreply`
--

CREATE TABLE `radreply` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `radusergroup`
--

CREATE TABLE `radusergroup` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `grupbilgisi`
--
ALTER TABLE `grupbilgisi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicibilgisi`
--
ALTER TABLE `kullanicibilgisi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `nas`
--
ALTER TABLE `nas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nasname` (`nasname`);

--
-- Tablo için indeksler `radacct`
--
ALTER TABLE `radacct`
  ADD PRIMARY KEY (`radacctid`),
  ADD UNIQUE KEY `acctuniqueid` (`acctuniqueid`),
  ADD KEY `username` (`username`),
  ADD KEY `framedipaddress` (`framedipaddress`),
  ADD KEY `framedipv6address` (`framedipv6address`),
  ADD KEY `framedipv6prefix` (`framedipv6prefix`),
  ADD KEY `framedinterfaceid` (`framedinterfaceid`),
  ADD KEY `delegatedipv6prefix` (`delegatedipv6prefix`),
  ADD KEY `acctsessionid` (`acctsessionid`),
  ADD KEY `acctsessiontime` (`acctsessiontime`),
  ADD KEY `acctstarttime` (`acctstarttime`),
  ADD KEY `acctinterval` (`acctinterval`),
  ADD KEY `acctstoptime` (`acctstoptime`),
  ADD KEY `nasipaddress` (`nasipaddress`),
  ADD KEY `bulk_close` (`acctstoptime`,`nasipaddress`,`acctstarttime`);

--
-- Tablo için indeksler `radcheck`
--
ALTER TABLE `radcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Tablo için indeksler `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupname` (`groupname`(32));

--
-- Tablo için indeksler `radgroupreply`
--
ALTER TABLE `radgroupreply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupname` (`groupname`(32));

--
-- Tablo için indeksler `radpostauth`
--
ALTER TABLE `radpostauth`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `radreply`
--
ALTER TABLE `radreply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Tablo için indeksler `radusergroup`
--
ALTER TABLE `radusergroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `grupbilgisi`
--
ALTER TABLE `grupbilgisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicibilgisi`
--
ALTER TABLE `kullanicibilgisi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `nas`
--
ALTER TABLE `nas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `radacct`
--
ALTER TABLE `radacct`
  MODIFY `radacctid` bigint(21) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `radcheck`
--
ALTER TABLE `radcheck`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `radgroupreply`
--
ALTER TABLE `radgroupreply`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `radpostauth`
--
ALTER TABLE `radpostauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `radreply`
--
ALTER TABLE `radreply`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `radusergroup`
--
ALTER TABLE `radusergroup`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
