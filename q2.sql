SELECT op.name, COUNT(td.id) as 'active_departures' FROM operator op
LEFT JOIN tour tr ON op.id = tr.operator_id
INNER JOIN tour_departure td ON td.tour_id = tr.id
WHERE td.active = 1 AND tr.active = 1
AND MONTH(td.date) = MONTH(CURRENT_DATE + INTERVAL 1 MONTH) 
GROUP BY op.name
ORDER BY active_departures DESC;