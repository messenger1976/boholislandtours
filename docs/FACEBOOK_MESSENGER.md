# Facebook Messenger Integration

Last updated: July 19, 2026

## Current implementation

The public website uses a floating Messenger button that links to:

`https://m.me/boholislandtours.ph`

Clicking the button opens a conversation with the Bohol Island Tours Facebook
Page. On mobile devices, the Messenger app may open; on desktop devices,
Messenger normally opens in a new browser tab and may ask the visitor to log
in.

The shared markup is in `footer.php`:

- Class: `.floating-messenger-btn`
- Accessible label: `Chat with us on Messenger`
- Link behavior: opens a new tab with `noopener noreferrer`
- Icon: inline Messenger SVG

Because all public pages include `footer.php`, the button appears throughout
the public website.

The button styling is in `assets/css/theme.css` under the
`Floating Messenger` section. It controls the fixed position, Messenger
gradient, shadow, size, and hover effect.

## Changing the Facebook Page

If the Page username changes, update this URL in `footer.php`:

```html
https://m.me/boholislandtours.ph
```

Replace `boholislandtours.ph` with the new Facebook Page username. Confirm that
messaging is enabled for the Page and test the link while logged out as well as
while logged in.

## Why the old embedded plugin was removed

Meta discontinued the Facebook Customer Chat Plugin on May 9, 2024. The former
implementation used:

- `fb-customer-chat`
- `window.fbAsyncInit`
- `xfbml.customerchat.js`

That code no longer provides a working chat window and should not be restored.
Meta stated that `m.me` links would remain available, which is why the website
uses the floating link instead.

## Limitation

The current button does not display a chat panel inside the website. It sends
the visitor to Messenger. Meta does not provide a direct replacement for its
discontinued embedded Customer Chat Plugin.

If an in-page chat window is required later, use a maintained third-party chat
provider. Before choosing one, verify:

1. Whether it can connect conversations to Facebook Messenger.
2. Subscription price and message limits.
3. Mobile and desktop behavior.
4. Privacy, cookie-consent, and data-retention requirements.
5. Whether its script affects page performance.
6. Whether the provider supports account export or migration.

Do not add an old Facebook SDK snippet presented as the former Customer Chat
Plugin; it will not restore the discontinued feature.

## Testing checklist

After changing the integration:

1. Open several public pages and confirm the button appears in the lower-right
   corner.
2. Confirm the button does not overlap the back-to-top control.
3. Click it on desktop and verify the correct Facebook Page conversation opens.
4. Test on Android and iOS, if available.
5. Test while logged out of Facebook to confirm the login flow is acceptable.
6. Check keyboard focus and confirm a screen reader announces
   `Chat with us on Messenger`.

## Relevant files

- `footer.php` — Messenger link and icon
- `assets/css/theme.css` — floating button presentation

## Reference

- Meta's former Chat Plugin documentation:
  <https://developers.facebook.com/docs/messenger-platform/discovery/facebook-chat-plugin/>
