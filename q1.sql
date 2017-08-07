SELECT tp.name, COUNT(tr.id) as 'tours' FROM tour tr
LEFT JOIN tour_type tt ON tr.id = tt.tour_id
INNER JOIN type tp ON tt.type_id = tp.id
WHERE tr.active = 1
GROUP BY tp.name
ORDER BY tp.name desc
LIMIT 3;