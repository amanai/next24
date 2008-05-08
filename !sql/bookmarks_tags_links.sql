-- Table: bookmarks_tags_links

-- DROP TABLE IF EXISTS `bookmarks_tags_links`;

CREATE TABLE `bookmarks_tags_links` (
  `id`                 int AUTO_INCREMENT NOT NULL COMMENT 'ID',
  `bookmarks_id`       int NOT NULL COMMENT 'bookmarks.ID закладки ',
  `bookmarks_tags_id`  int NOT NULL COMMENT 'bookmarks_tags.ID тега',
  /* Keys */
  PRIMARY KEY (`id`)
) ENGINE = MyISAM
  COMMENT = '“аблица св€зей закладок (bookmarks) и тегов (bookmarks_tags)';

