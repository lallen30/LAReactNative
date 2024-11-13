Here's the recommended strategy to convert the Ionic application to React Native:

1. Setup Phase:

- Create a new React Native project using React Native CLI (not Expo, since this app has complex native requirements)
- Setup a similar folder structure in the new project to maintain organization
- Install equivalent React Native dependencies:
  - @react-navigation/native (for routing, replacing Angular Router)
  - @react-native-async-storage/async-storage (replacing Ionic Storage)
  - @react-native-community/netinfo (replacing Capacitor Network)
  - react-native-calendar (replacing ionic2-calendar)
  - react-native-swiper (replacing Swiper)
  - react-native-date-fns (replacing date-fns)
  - moment (can keep using this)

1. Component Migration:

- Convert Angular components to React Native components:
  - Replace Ionic UI components with React Native equivalents
  - Convert SCSS styles to React Native StyleSheet objects
  - Transform Angular services into React hooks or context
  - Replace Angular forms with React Native form handling
  - Convert Angular dependency injection patterns to React patterns

1. State Management:

- Replace RxJS observables with React hooks or Redux
- Convert Angular services to React context or custom hooks
- Implement proper state management using Redux or Context API

1. Native Functionality:

- Replace Capacitor plugins with React Native equivalents:
  - react-native-haptics
  - @react-native-community/async-storage
  - react-native-keyboard-manager
  - react-native-network-info
  - react-native-status-bar

1. Platform-Specific Code:

- Rewrite iOS/Android specific code using React Native's Platform API
- Migrate native configurations from Capacitor to React Native
- Update native assets and resources

1. Testing & Optimization:

- Implement new tests using React Native Testing Library
- Optimize performance using React Native best practices
- Ensure proper handling of lifecycle methods

Key Considerations:

1. This should be done incrementally, feature by feature
2. Start with core functionality, then add complex features
3. Test thoroughly on both platforms during migration
4. Consider using React Native UI libraries like React Native Paper or Native Base for faster development
5. Maintain a similar folder structure to keep code organized
6. Document all changes and new patterns for team reference

The migration will require significant effort due to:

- Fundamental differences between Angular and React paradigms
- Different styling approaches (SCSS vs StyleSheet)
- Native functionality implementation differences
- State management architecture changes
- Platform-specific considerations

It's recommended to:

1. Create the new React Native project alongside the existing Ionic app
2. Migrate features one at a time
3. Maintain both apps until the migration is complete
4. Have thorough testing at each stage
5. Consider using TypeScript in React Native to maintain type safety

Please create a new React Native project using React Native CLI (not Expo)
Please add a login screen with email and password fields that will will use the following endpoint to authenticate the user:
https://wordpress.betaplanets.com/wp-json/jwt-auth/v1/token
POST:
{
"email": "user1@knoxweb.com",
"password": "sR123456"
}

Response:
{
"code": 200,
"status": "ok",
"msg": "You are login successfully.",
"error_code": "",
"loginInfo": {
"join_year": "Dec 2023",
"user_id": 13,
"user_email": "user1@knoxweb.com",
"email": "user1@knoxweb.com",
"last_name": "Washington",
"first_name": "George",
"name": "George Washington",
"display_name": "George Washington",
"roles": [
"subscriber"
],
"role": "player",
"user_avatar": "https://wordpress.betaplanets.com/wp-content/uploads/2024/07/cropped-George_Washington-scaled-1.jpg",
"phone": "865-456-4848",
"project": "Our Founding Father App",
"company": "Bluestone Apps",
"street1": "123 some Rd",
"street2": "Suite 115",
"city": "Knoxville",
"state": "TN",
"zipcode": "37919",
"about": "I'm a cool dude!",
"setting": "",
"city_state": "Knoxville, TN",
"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvd29yZHByZXNzLmJldGFwbGFuZXRzLmNvbSIsImlhdCI6MTczMDk5MzE4MywibmJmIjoxNzMwOTkzMTgzLCJleHAiOjIzNTg5MTc5ODMsImRhdGEiOnsidXNlciI6eyJpZCI6IjEzIn19fQ.65lqRQTugxO5YU78-RCPbFdEJ2RKf867x_GFzX-ogNg"
}
}

https://wordpress.betaplanets.com/wp-json/jwt-auth/v1/token/validate
POST
Bearer Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYWxleC1wbGF5LmJldGFwbGFuZXRzLmNvbSIsImlhdCI6MTY5ODkzNjE2MSwibmJmIjoxNjk4OTM2MTYxLCJleHAiOjIzMjY4NjA5NjEsImRhdGEiOnsidXNlciI6eyJpZCI6IjUifX19.w4vDvXBqD4FvN5anfBX2Aa-hW40igREQBAhJO6vWaWU

Response:
{
"code": "jwt_auth_valid_token",
"data": {
"status": 200
}
}

Once logged in, please display a simple welcome page.
