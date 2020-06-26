#
# Table structure for table 'tt_content'
#
#
CREATE TABLE tt_content (
	news_ttnewsimport_new_id int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_news_domain_model_news'
#
#
CREATE TABLE tx_news_domain_model_news (
	tx_aunewsevent_from int(11) DEFAULT '0' NOT NULL,
	tx_aunewsevent_to int(11) DEFAULT '0' NOT NULL,
	tx_aunewsevent_where varchar(255) DEFAULT '' NOT NULL,
	tx_aunewsevent_organizer varchar(255) DEFAULT '' NOT NULL,
	tx_aunewsevent_organizer_email varchar(255) DEFAULT '' NOT NULL,
	tx_aunewsevent_regfrom int(11) DEFAULT '0' NOT NULL,
	tx_aunewsevent_regto int(11) DEFAULT '0' NOT NULL,
	tx_aunewsevent_regurl varchar(255) DEFAULT '' NOT NULL,
	tx_aunewsevent_preview_end int(11) DEFAULT '0' NOT NULL,
	tx_aunewsevent_preview_hash varchar(255) DEFAULT '' NOT NULL,
	tx_aunewsevent_showyear tinyint(4) DEFAULT '0' NOT NULL,
	tx_lfaunewsserver_emne int(11) DEFAULT '0' NOT NULL,
	tx_rgnewsimg_design int(11) DEFAULT '0' NOT NULL
);