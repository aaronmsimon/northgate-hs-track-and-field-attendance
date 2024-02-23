# Northgate High School Track and Field Attendance Tracker

![GitHub License](https://img.shields.io/github/license/aaronmsimon/northgate-hs-track-and-field-attendance)
![GitHub commit activity](https://img.shields.io/github/commit-activity/w/aaronmsimon/northgate-hs-track-and-field-attendance)
![GitHub last commit](https://img.shields.io/github/last-commit/aaronmsimon/northgate-hs-track-and-field-attendance)
![GitHub language count](https://img.shields.io/github/languages/count/aaronmsimon/northgate-hs-track-and-field-attendance)

![Northgate Broncos](https://github.com/aaronmsimon/northgate-hs-track-and-field-attendance/blob/main/project-root/public/img/BroncosOfficialLogo2016yellowgold.png?raw=true)

<a href="http://www.northgatetrackandfieldcheck.in/check-in"><img src="https://raw.githubusercontent.com/aaronmsimon/northgate-hs-track-and-field-attendance/main/project-root/public/img/qr-code-attendance.png" width="250"/></a>

## Version History
| Version | Release Date | Description |
| --- | --- | --- |
| 0.1 | 2024-02-09 | MVP |
| 0.2 | 2024-02-22 | Coaches' Tracking |

## Backlog

### Error Handling
1. Enable new student (no record in DB) tracking
    - partially handled - error message will be thrown

### Coaches' Features
1. View student attendance over time
    - ~~Profile page~~
    - ~~Calendar displaying attendance~~
    - Attendance stats
2. Export attendance to CSV

### Fun Features
1. Add badges (gamification)
2. Leaderboard ideas
    - Longest check-in streak
    - Saturday check-ins

### Formatting
1. Add flare to design instead of solid background

### Technical Improvements
1. No direct access to coaches page
2. ~~Add year to roster to avoid having to clear database each season~~  sort of (no validation for finding active/current year student)
3. Fix double validation errors appearing
4. Disable check-in based on time of day
5. Look for security risks and prevent SQL injection
6. Add geocoding to check-in

### Questions
1. Should this be used for meets?
