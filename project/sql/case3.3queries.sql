/*1. Total income of Restaurant till now.*/
SELECT sum(grandTotal) from `restaurant`.`order`;

/*2. Customer who visited the restaurant more than twice.*/
SELECT category.title FROM poll.category, poll.pollCategory, poll.pollQuestion 
WHERE category.pollId = pollCategory.pollId AND pollQuestion.pollId = pollCategory.pollId
HAVING count(pollQuestion.pollQueId) > 2;

/*3. List of all menus with its menu items.*/
select menu.title , item.title from `restaurant`.`menu`,`restaurant`.`item`,`restaurant`.`menuItem`
WHERE `menu`.`menuId` = `menuItem`.`menuId`
AND `menuItem`.`itemId` = `item`.`itemId`;

/*4. List out all the unique ids and possible indexes for this DB schema.*/
/*
UNIQUE ID	TABLE		COLUMN
			user		email
            menu		title
            item		title
            order		email


/*5. List out total order placed by each User.*/
SELECT userId,COUNT(orderId) FROM restaurant.order 
group by userId;

/*6. Make a list of each user and the highest-priced menu item he or she ordered.*/
SELECT `order`.`userId` , MAX(orderItem.price) from restaurant.orderItem JOIN `restaurant`.`order`
ON`order`.orderId = orderItem.orderId
group by userId;

/*7. Retrieve the name of a chef who prepares more recipes than any other chef.*/
SELECT firstname FROM `restaurant`.`user` , `restaurant`.`itemChef`  
WHERE user.userId = itemChef.chefId HAVING count(itemChef.itemId) > 1; 

/*8. Retrieve the amount of subtotal for all day on 9th November 2021. (It does not include the total, formula: item price * ordered qty).*/
SELECT sum(price*quantity) as subtotal FROM `restaurant`.`orderItem`
WHERE craetedAt = '2022-01-01';

/*9. List out user along with the average amount spend at the restaurant.*/
SELECT `order`userId , AVG(`order`.`grandTotal`) FROM restaurant.`order`
group by `order`.userId;

/*10. List out the menu items which are preferred by the customer at dinner time*/
/*SELECT `item`.`title` from `restaurant`.`item`
JOIN restaurant.orderItem ON item.itemId = orderItem.itemId 
JOIN `restaurant`.`order` ON orderItem.orderId = `order`.`orderId`
HAVING craetedAt BETWEEN '18:00:00' AND '00:00:00';
*/
use restaurant;
SELECT i.itemId , i.title , oi.craetedAt AS EveningTime  FROM `restaurant`.`item` AS i 
INNER JOIN `restaurant`.`orderItem` AS oi 
WHERE i.`itemId` = oi.`itemId` 
GROUP BY oi.`itemId` 
HAVING DATE_FORMAT(oi.craetedAt,'%H:%i:%s') BETWEEN '17:00:00' AND '23:00:00';

/***************************************************************************************/

/*1. List out all questions with it’s answer which is having maximum vote.**/

USE poll;
select * from poll.pollanswer; 
select * from poll.pollquestion;
select * from poll.pollvote;
select pollquestion.pollQueId,pollanswer.pollAnsId,max(pollvote.pollQueId)as maximumVote 
from pollquestion join pollanswer on pollquestion.pollQueId=pollanswer.pollAnsId 
join pollvote on pollvote.pollQueId=pollquestion.pollQueId 
group by pollvote.userId;

/*2. List out all the categories which is having multiple poll questions under it.*/
SELECT category.title FROM poll.category,poll.pollCategory,poll.pollQuestion
WHERE category.pollId = pollCategory.pollId
AND pollQuestion.pollId = pollCategory.pollId
HAVING COUNT(pollQuestion.pollId) > 2;

/*3. List out all the polls which are currently active.*/
SELECT pp.title FROM `poll`.`poll` AS pp WHERE TO_DAYS(pp.endsAt) <= TO_DAYS(current_date()); 

/*4. List out all the users who is not logged in since last week.*/
SELECT users.firstName FROM `poll`.`users` WHERE to_days(current_date())  - to_days(users.lastLogin)  > 7 ;

/*5. List out all the users whose email provider is not google.*/
SELECT users.email FROM `poll`.`users` WHERE users.email NOT LIKE '%@gmail.com';

/*6. List out all the polls which are published in 2021.*/
SELECT * FROM poll.poll
WHERE YEAR(publishedAt) = 2021;

/*7. List out all the users who did not answer any poll yet.*/
SELECT users.firstName FROM `poll`.`users` WHERE users.userId NOT IN (SELECT pollVote.userId FROM poll.pollVote);

/*8. Create all the possible unique key and indexes for this database schema.*/
/*
UNIQUE KEY	TABLE		COLUMN
			users		email
            pollmeta	key
            category	title
            tag			title
            
            
            */