import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, AbstractControl } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { ActivityService } from '../../../services/activity.service';
import { Activity } from '../../../domain/activity.model';
import { categories } from '../../shared/constants/categories.constants';
import { BaseComponent } from '../../../core/base.component';

@Component({
  selector: 'app-activity',
  templateUrl: './activity.component.html',
  styleUrls: ['./activity.component.css']
})
export class ActivityComponent extends BaseComponent implements OnInit {

  public activity: Activity;
  public activityForm: FormGroup;
  public categories: String[];

  constructor(private route: ActivatedRoute,
              private formBuilder: FormBuilder,
              private activitiyService: ActivityService) {
    super();
  }

  ngOnInit() {
    this.categories = categories;
    this.sub = this.route.params.subscribe(params => {
      const activityID: number = Number.parseInt(params.activityID, 10);
      if (activityID) {
        this.activitiyService.get(activityID)
          .subscribe(
            res => {
              this.activity = res;
              this.presetForm();
            },
            () => console.log('Error retrieving activity.')
        );
      }
    });
    this.createForm();
  }


  private createForm(): void {
    this.activityForm = this.formBuilder.group({
      title: ['', [Validators.required]],
      description: ['', [Validators.required]],
      location: ['', [Validators.required]],
      category: [null, [Validators.required]],
      start: [null, [Validators.required]],
      end: [null, [Validators.required]]
    });
  }

  private presetForm(): void {

  }
}
