SELECT tr.id,  tr.name, td.price FROM tour tr
INNER JOIN tour_departure td ON td.tour_id = tr.id
INNER JOIN tour_type tt ON tt.tour_id = tr.id
INNER JOIN type tp ON tp.id = tt.type_id
WHERE td.active = 1 AND td.price > 3000
GROUP BY tr.id
HAVING COUNT(td.id) > 7
AND COUNT(DISTINCT tt.id) = 1
