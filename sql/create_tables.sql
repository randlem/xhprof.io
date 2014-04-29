DROP TABLE IF EXISTS `callgraphs`;
CREATE TABLE `callgraphs` (
  `runId`   VARCHAR(40) NOT NULL,
  `caller`  VARCHAR(255) DEFAULT NULL,
  `callee`  VARCHAR(255) NOT NULL,
  `ct`      INTEGER UNSIGNED DEFAULT NULL,
  `wt`      INTEGER UNSIGNED DEFAULT NULL,
  `cpu`     INTEGER UNSIGNED DEFAULT NULL,
  `mu`      INTEGER UNSIGNED DEFAULT NULL,
  `pmu`     INTEGER UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`runId`, `callee`, `caller`),
  KEY `idx_caller_callee` (`caller`,`callee`)
);

DROP TABLE IF EXISTS `runs`;
CREATE TABLE `runs` (
  `id`      VARCHAR(40) NOT NULL,
  `uri`     VARCHAR(1024) NOT NULL,
  `method`  VARCHAR(10) NOT NULL,
  `server`  VARCHAR(20) NOT NULL,
  `time`    INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uri` (`uri`(20)),
  KEY `idx_method` (`method`),
  KEY `idx_server` (`server`)
);
