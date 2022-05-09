CREATE TABLE IF NOT EXISTS `api_users` (
    `id` int(11) NOT NULL,
    `login` varchar(50) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
    `password` varchar(50) NOT NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `students` (
    `id` int(11) NOT NULL,
    `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `students` (`id`, `name`) VALUES
(4, 'Alex'),
(7, 'Alice'),
(3, 'Bill'),
(5, 'Dakota'),
(1, 'Jack'),
(2, 'Jane'),
(8, 'Mike'),
(6, 'Nick'),
(11, 'Vašek'),
(9, 'Роман'),
(10, 'Юрий'),
(12, 'დავით');

CREATE TABLE IF NOT EXISTS `user_tokens` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `token` varchar(50) CHARACTER SET latin1 NOT NULL,
    `ts` int(11) NOT NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `api_users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

ALTER TABLE `students`
    ADD PRIMARY KEY (`id`),
  ADD KEY `student_name` (`name`);

ALTER TABLE `user_tokens`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

INSERT INTO users SET login='root', password=sha1('passwordsalty-random-string');