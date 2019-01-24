SELECT id,
      content,
      description
      (select count(*) from Likes where user_id = :user_id AND post_id = :post_id) as Likes
      FROM Posts;
