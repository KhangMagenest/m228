SELECT `main_table`.*,
       `director`.`name` AS `director_name`,
       group_concat(actor.name) AS `actor_name`,
       group_concat(actor.actor_id) AS `actor_name`
FROM `magenest_movie` AS `main_table`
INNER JOIN `magenest_director` AS `director` ON main_table.director_id = director.director_id
INNER JOIN `magenest_movie_actor` AS `movie_actior` ON main_table.movie_id = movie_actior.movie_id
INNER JOIN `magenest_actor` AS `actor` ON actor.actor_id = movie_actior.actor_id
GROUP BY `main_table`.`movie_id`

-- SELECT * from magenest_movie