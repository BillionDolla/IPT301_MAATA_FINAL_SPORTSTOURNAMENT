import SportsTeamController from './SportsTeamController';
import DashboardController from './DashboardController';
import PlayerController from './PlayerController';
import TournamentController from './TournamentController';
import MatchController from './MatchController';
import ScoreController from './ScoreController';
import Settings from './Settings';
import Teams from './Teams';
const Controllers = {
    SportsTeamController: Object.assign(
        SportsTeamController,
        SportsTeamController,
    ),
    DashboardController: Object.assign(
        DashboardController,
        DashboardController,
    ),
    PlayerController: Object.assign(PlayerController, PlayerController),
    TournamentController: Object.assign(
        TournamentController,
        TournamentController,
    ),
    MatchController: Object.assign(MatchController, MatchController),
    ScoreController: Object.assign(ScoreController, ScoreController),
    Settings: Object.assign(Settings, Settings),
    Teams: Object.assign(Teams, Teams),
};

export default Controllers;
