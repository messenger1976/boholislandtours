-- Seed / sync Tour Packages Offer to match main website packages.
-- Safe to re-run: updates by room_code when present.

UPDATE rooms SET
  room_name='Chocolate Hills Adventure', room_type='Day Tour', room_code='chocolate-hills-adventure',
  price=1500.00, capacity=10, available_rooms=5,
  description='Full-day countryside adventure covering Chocolate Hills and iconic Bohol highlights. Transport, guide, entrance fees and lunch included.',
  amenities='Transport; Licensed guide; Entrance fees; Lunch', status='active'
WHERE id=1;

UPDATE rooms SET
  room_name='Panglao Beach Paradise', room_type='Day Tour', room_code='panglao-beach-paradise',
  price=2200.00, capacity=10, available_rooms=5,
  description='Full-day Panglao beach experience with boat transfer, beach activities, snorkeling and lunch.',
  amenities='Boat transfer; Beach activities; Snorkeling; Lunch', status='active'
WHERE id=2;

UPDATE rooms SET
  room_name='Tarsier & Wildlife Tour', room_type='Day Tour', room_code='tarsier-wildlife-tour',
  price=1800.00, capacity=10, available_rooms=5,
  description='Half-day wildlife tour with transport, guide, sanctuary entry and photo session.',
  amenities='Transport; Guide; Sanctuary entry; Photo session', status='active'
WHERE id=3;

UPDATE rooms SET
  room_name='Loboc River Experience', room_type='Day Tour', room_code='loboc-river-experience',
  price=1300.00, capacity=10, available_rooms=5,
  description='Half-day Loboc River cruise with buffet lunch and cultural show.',
  amenities='River cruise; Buffet lunch; Cultural show', status='active'
WHERE id=4;

UPDATE rooms SET
  room_name='Bohol Island Hopping', room_type='Day Tour', room_code='bohol-island-hopping',
  price=2500.00, capacity=10, available_rooms=5,
  description='Full-day island hopping across multiple islands with snorkeling, marine life viewing and lunch.',
  amenities='Multiple islands; Snorkeling; Marine life; Lunch', status='active'
WHERE id=5;

UPDATE rooms SET
  room_name='2 Days 1 Night Bohol Tour', room_type='Multi-Day Package', room_code='package-2d1n',
  price=1500.00, capacity=12, available_rooms=8,
  description='2D/1N package with 5 flexible plans: countryside, island hopping, Panglao or Danao. Hotels and transport included. Quotation-based from ₱1,500.',
  amenities='1 night accommodation; A/C car/van + driver/guide; Loboc cruise lunch; Entrance fees; Airport/seaport transfers', status='active'
WHERE id=6;

INSERT INTO rooms (room_name, room_type, room_code, price, capacity, available_rooms, description, amenities, status)
SELECT '3 Days 2 Nights Bohol Tour', 'Multi-Day Package', 'package-3d2n', 2000.00, 12, 8,
  '3D/2N package with countryside highlights plus island time or free Panglao afternoon. From ₱2,000.',
  '2 nights accommodation; Car/van + driver/guide; Loboc cruise + lunch; Entrance fees & transfers', 'active'
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM rooms WHERE room_code='package-3d2n');

INSERT INTO rooms (room_name, room_type, room_code, price, capacity, available_rooms, description, amenities, status)
SELECT '4 Days 3 Nights Bohol Tour', 'Multi-Day Package', 'package-4d3n', 2500.00, 12, 8,
  '4D/3N balanced itinerary with free time, island hopping or Danao options. From ₱2,500.',
  '3 nights stay; Transfers & guided tours; Loboc lunch cruise; Entrance fees', 'active'
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM rooms WHERE room_code='package-4d3n');

INSERT INTO rooms (room_name, room_type, room_code, price, capacity, available_rooms, description, amenities, status)
SELECT '5 Days 4 Nights Bohol Tour', 'Multi-Day Package', 'package-5d4n', 3000.00, 12, 8,
  'Ultimate 5D/4N complete island experience with countryside, islands, beaches, adventure and leisure days. From ₱3,000.',
  '4 nights accommodation; Private transport & guide; Loboc cruise lunch; Listed entrance fees & transfers', 'active'
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM rooms WHERE room_code='package-5d4n');
