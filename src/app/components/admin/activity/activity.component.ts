import { Component, OnInit } from '@angular/core';
import { COMMA, ENTER } from '@angular/cdk/keycodes';
import { FormBuilder, FormGroup, Validators, AbstractControl } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { MatChipInputEvent } from '@angular/material/chips';
import { MatAutocompleteSelectedEvent, MatAutocomplete } from '@angular/material/autocomplete';
import { finalize } from 'rxjs/operators';

import { ActivityService } from '../../../services/activity.service';
import { Activity } from '../../../domain/activity.interface';
import { CATEGORIES } from '../../shared/constants/categories.constants';
import { BaseComponent } from '../../../core/base.component';
import { Tag } from '../../../domain/tag.interface';
import { TagService } from '../../../services/tag.service';
import { Image } from '../../../domain/image.interface';
import { Video } from '../../../domain/video.interface';

@Component({
  selector: 'app-activity',
  templateUrl: './activity.component.html',
  styleUrls: ['./activity.component.css']
})
export class ActivityComponent extends BaseComponent implements OnInit {

  readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  visible = true;
  selectable = true;
  removable = true;
  addOnBlur = true;
  public activity: Activity;
  public activityForm: FormGroup;
  public categories: String[];
  public isButtonDisabled = true;
  public tags: Tag[];
  public images: Image[];
  public videos: Video[];
  public existingTags : Tag[];

  constructor(private route: ActivatedRoute,
              private formBuilder: FormBuilder,
              private activityService: ActivityService,
              private tagService: TagService) {
    super();
  }

  ngOnInit() {
    this.categories = CATEGORIES;
    this.createForm();
    this.sub = this.route.params.subscribe(params => {
      const activityID: number = Number.parseInt(params.activityID, 10);
      if (activityID) {
        this.sub = this.activityService.get(activityID)
          .subscribe(
            (res) => {
              this.activity = res;
              this.presetForm();
            },
            () => console.log('Error retrieving activity.')
        );
      } else {
        this.isButtonDisabled = false;
      }
    });
    this.sub = this.tagService.getAll()
      .subscribe(
        (res) => this.existingTags = res,
        (res) => this.onError(res)
      );
  }

  private createForm(): void {
    this.activityForm = this.formBuilder.group({
      title: ['', [Validators.required]],
      description: ['', [Validators.required]],
      location: ['', [Validators.required]],
      category: [null, [Validators.required]],
      start: [null, [Validators.required]],
      end: [null, [Validators.required]],
      tags: [null],
      images: [null],
      videos: [null]
    });
  }

  private presetForm(): void {
    this.activityForm.setValue({
      title: this.activity.title || '',
      description: this.activity.description || '',
      location: this.activity.location || '',
      category: this.activity.category || null,
      start: this.activity.startDate || null,
      end: this.activity.endDate || null,
      tags: this.activity.tags || null,
      images: this.activity.images || null,
      videos: this.activity.videos || null
    });
    this.isButtonDisabled = this.activityForm.invalid;
  }

  public save(): void {
    this.isButtonDisabled = true;
    const body: Activity = { ...this.activityForm.value };

    if (this.activity) {
    } else {
      this.sub = this.activityService.create(body)
        .pipe(finalize(() => this.isButtonDisabled = false))
        .subscribe(
          (res) => {
            this.activity = res;
          },
          res => this.onError(res)
        );
    }
  }


  public addTag(event: MatChipInputEvent): void {
    const input = event.input;
    const value = event.value;

    // Add our fruit
    if ((value || '').trim()) {
      const tag = {
        id: null,
        name: value.trim(),
        authorID: null,
        creationDate: null
      };
      this.sub = this.tagService.create(tag)
        .subscribe(
          (res) => this.tags.push(res),
          res => this.onError(res)
        );
    }
    // Reset the input value
    if (input) {
      input.value = '';
    }
  }

  public removeTag(tag: Tag): void {
    const index = this.tags.findIndex(elem => elem.id === tag.id)
    if (index >= 0) {
      this.tags.splice(index, 1);
    }
  }
}
